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

namespace Tenancy\Bridge\Hyn;

use Illuminate\Support\ServiceProvider;

class HynServiceProvider extends ServiceProvider
{
    public function register()
    {
        config(['tenancy.models.hostname' => Models\Hostname::class]);
        config(['tenancy.models.website' => Models\Website::class]);
    }
}
