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

use Hyn\Tenancy\Contracts\Hostname as Contract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Tenancy\Identification\Contracts\Tenant;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;

class Hostname extends Model implements IdentifiesByHttp, Contract
{

    /**
     * Specify whether the tenant model is matching the request.
     *
     * @param Request $request
     * @return Tenant
     */
    public function tenantIdentificationByHttp(Request $request): ?Tenant
    {
        $host = $request->getHost();

        $hostname = $this->newQuery()
            ->with('website')
            ->where('fqdn', $host)
            ->first();

        return $hostname ? $hostname->website : null;
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
