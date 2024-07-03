<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string|null $description
 * @property string|null $contacts
 * @property int $avatar_file_id
 * @property int $ts_file_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read File|null $avatarFile
 * @property-read File|null $tsFile
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereAvatarFileId($value)
 * @method static Builder|Project whereContacts($value)
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereTsFileId($value)
 * @method static Builder|Project whereType($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Project extends Model
{
    const DOWNLOAD_FILE_AVATAR = 'avatar';
    const DOWNLOAD_FILE_TS = 'ts';
    const DOWNLOAD_FILE_ZIP = 'zip';
    protected $fillable = [
        'type', 'description', 'contacts'
    ];

    protected $hidden = [
        'avatar_file_id',
        'avatarFile',
        'ts_file_id',
        'tsFile',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'avatar_file_url',
        'ts_file_url',
    ];

    public function avatarFile(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'avatar_file_id');
    }

    public function tsFile()
    {
        return $this->hasOne(File::class, 'id', 'ts_file_id');
    }

    public function avatarFileUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->avatarFile->url
        );
    }

    public function tsFileUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tsFile->url
        );
    }

    public function getAllFiles(): Collection
    {
        return File::whereIn('id', [$this->avatar_file_id, $this->ts_file_id])->get();
    }




}
