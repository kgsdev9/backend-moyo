<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $listeservices = Transaction::all();
        return response()->json($listeservices);
    }

    public function store(Request $request)
    {

        // dd($request->montant);
        // return response()->json($listeservices);

        $data = [
            'merchantId' => "PP-F2197",
            'amount' => 566,
            'description' => "stephane",
            'channel' => 'WAVECI',
            'countryCurrencyCode' => 952,
            'referenceNumber' => "+33499998",
            'customerEmail' => "kgsdev8@gmail.com",
            'customerFirstName' => "KGS DEV",
            'customerLastname' => "WAVE COTE D'VIOIRE",
            'customerPhoneNumber' => "999944564",
            'notificationURL' => route('payment.status'),
            'returnURL'  => route('payment.status'),
            'returnContext' => '',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paiementpro.net/webservice/onlinepayment/init/curl-init.php");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Exécution de la requête
        $response = curl_exec($ch);

        // Gestion des erreurs cURL
        if (curl_errno($ch)) {
            return response()->json(['error' => 'Erreur de communication avec le service de paiement.'], 500);
        }

        curl_close($ch);

        // Décodage de la réponse
        $obj = json_decode($response);
        if (!isset($obj->url)) {
            return response()->json(['error' => 'URL de paiement non reçue.'], 500);
        }


        // URL de paiement
        $urlPayement = $obj->url;

        // Retourner la réponse en JSON
        return response()->json(['payment_url' => $urlPayement], 200);
    }
}
