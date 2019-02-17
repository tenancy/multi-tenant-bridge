<?php declare(strict_types=1);

/*
 * This file is part of the tenancy/tenancy package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see http://laravel-tenancy.com
 * @see https://github.com/tenancy
 */

namespace Tenancy\Bridge\Hyn\Models;

use Hyn\Tenancy\Contracts\Website as Contract;
use Hyn\Tenancy\Contracts\Tenant as LegacyTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant;

class Website extends Model implements Tenant, Contract, LegacyTenant
{
    use AllowsTenantIdentification;

    public function hostnames(): HasMany
    {
        return $this->hasMany(Hostname::class);
    }
}
