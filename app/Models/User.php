<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string|null $phone
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $avatar
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereCurrentAddress($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User find($id)
 * @method static Builder|User findOrFail($value)
 * @method static Builder|User create($array)
 */
class User extends Authenticatable implements MustVerifyEmail, HasAvatar, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    public function getAvatarPathAttribute(): ?string
    {
        return $this->avatar ? Storage::url($this->avatar) : $this->getFilamentAvatarUrl();
    }

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn() => ucfirst($this->name) . ' ' . ucfirst($this->surname));
    }

    public function getFullAvatarAttribute(): ?string
    {
        return $this->getFilamentAvatarUrl();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return filled($this->avatar) && file_exists(Storage::path($this->avatar))
            ? url(Storage::url($this->avatar))
            : 'https://ui-avatars.com/api/?name=' . $this->name . '+' . $this->surname;
    }

    public function findContractWith($recipient_id): BelongsToMany
    {
        return $this->belongsToMany(Contract::class)
            ->wherePivot('recipient_id',$recipient_id)
            ->withTimestamps();
    }
    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class)
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

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function  getIsApprovedByAdminAttribute() : bool
    {
        return $this->status === 'active';
    }
    public function  products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function  temporaryFile() : HasMany
    {
        return $this->hasMany(TemporaryFile::class);
    }
}
