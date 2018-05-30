<?php

namespace App\Models;

use App\Traits\ModelRulesTrait;
use App\Traits\SoftDeletesTrait;
use App\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ModelWithSoftDeletes extends Model implements AuditableContract
{
    use SoftDeletesTrait, RelationshipsTrait, ModelRulesTrait, AuditableTrait;
}