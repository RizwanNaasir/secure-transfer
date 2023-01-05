<?php

namespace App\Models;

use App\Traits\CanBeRated;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, HasAvatar, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, CanBeRated;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'full_name',
        'full_avatar',
        'is_approved_by_admin',
        'document1_path',
        'document2_path'
    ];

    public function getAvatarPathAttribute(): ?string
    {
        return $this->avatar ? Storage::url($this->avatar) : $this->getFilamentAvatarUrl();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return filled($this->avatar) && file_exists(Storage::path($this->avatar))
            ? url(Storage::url($this->avatar))
            : 'https://ui-avatars.com/api/?name=' . $this->name . '+' . $this->surname;
    }

    public function getDocument1PathAttribute(): ?string
    {
        return filled($this->document1) && file_exists(Storage::path($this->document1))
            ? url(Storage::url($this->document1))
            : null;
    }

    public function getDocument2PathAttribute(): ?string
    {
        return filled($this->document2) && file_exists(Storage::path($this->document2))
            ? url(Storage::url($this->document2))
            : null;
    }

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn() => ucfirst($this->name) . ' ' . ucfirst($this->surname));
    }

    public function getFullAvatarAttribute(): ?string
    {
        return $this->getFilamentAvatarUrl();
    }

    public function findContractWith($recipient_id): BelongsToMany
    {
        return $this->belongsToMany(Contract::class)
            ->wherePivot('recipient_id', $recipient_id)
            ->withTimestamps();
    }

    public function receivedContracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class, foreignPivotKey: 'recipient_id', relatedPivotKey: 'contract_id')
            ->withTimestamps();
    }

    public function allContracts(): BelongsToMany
    {
        return $this->contracts()->orWherePivot('recipient_id', $this->id);
    }

    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class)
            ->withTimestamps();
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function canAccessFilament(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function getIsApprovedByAdminAttribute(): bool
    {
        return $this->status === 'active';
    }

    public function isAdmin(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function temporaryFile(): HasMany
    {
        return $this->hasMany(TemporaryFile::class);
    }

    public function changeStatus(string $status)
    {
        $this->update(['status' => $status]);
        $notification = Notification::make()->title('User ' . $status);
        $notification = $status === 'active'
            ? $notification->success()
            : $notification->danger();
        $notification->send();
    }
}
