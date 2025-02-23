<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'reference',
        'user_id',
        'modereglement_id',
        'service_id',
        'modereglementname',
        'montant',
        'status'
    ];

    // Définir les relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modeReglement()
    {
        return $this->belongsTo(ModeReglement::class, 'modereglement_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Définir des accès (accessors) ou des mutateurs (mutators) si nécessaire
    public function getMontantAttribute($value)
    {
        return number_format($value, 2, ',', ' ');
    }
}
