<?php

namespace App\Pipelines;

use Closure;

abstract class PipelineFactory
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        return $this->apply($builder);
    }

    protected abstract function apply($builder);
}
