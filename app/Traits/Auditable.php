<?php

namespace App\Traits;

use App\AuditLog;
use App\User;
use Illuminate\Database\Eloquent\Model;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            self::audit('created', $model);
        });

        static::updated(function (Model $model) {
            self::audit('updated', $model);
        });

        static::deleted(function (Model $model) {
            self::audit('deleted', $model);
        });
    }

    protected static function audit($description, $model)
    {
        if ($model instanceof User) {
            unset(
                $model->roles,
                $model->subCategories,
                $model->categories,
                $model->documents,
                $model->courses,
                $model->content
            );
        }

        AuditLog::query()
            ->create([
                'description'  => $description,
                'subject_id'   => $model->id ?? null,
                'subject_type' => get_class($model) ?? null,
                'user_id'      => auth()->id() ?? null,
                'properties'   => $model ?? null,
                'host'         => request()->ip() ?? null,
            ]);
    }
}
