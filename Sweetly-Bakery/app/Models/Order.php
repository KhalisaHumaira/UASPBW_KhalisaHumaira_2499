<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
    protected $fillable = ['user_id','order_code','delivery_address','delivery_date','delivery_time','note','total_price','status','payment_method','payment_status'];
    protected $casts = ['delivery_date'=>'date'];
    public function user()  { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function getStatusLabelAttribute(): string {
        return match($this->status) {
            'pending'   => '⏳ Menunggu Konfirmasi',
            'confirmed' => '✅ Dikonfirmasi',
            'process'   => '👩‍🍳 Sedang Dibuat',
            'ready'     => '📦 Siap Dikirim',
            'delivered' => '🎉 Terkirim',
            'cancelled' => '❌ Dibatal',
            default     => $this->status,
        };
    }
    public function getStatusClassAttribute(): string {
        return match($this->status) {
            'pending'   => 'badge-pending',
            'confirmed' => 'badge-confirmed',
            'process'   => 'badge-process',
            'ready'     => 'badge-ready',
            'delivered' => 'badge-delivered',
            'cancelled' => 'badge-cancelled',
            default     => '',
        };
    }
}
