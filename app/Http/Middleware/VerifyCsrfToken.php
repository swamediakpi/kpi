<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/logout',
        'hrd',
        'hrd/search',
        'hrd/input',
        'project/input',
        'days/search',
        'days_project/input',
        'reportkpi/search',
        'mandays/search',
        'index/GrafEmp',
        'index/GrafEvo',
        'index/GrafMnd',
        'days_project/start',
        'forgetstart/input',
        'forgetpause/input',
        'forgetstop/input',
        'touchstart/del',
        'touchpause/del',
        'touchstop/del',
        'days/search',
        'days-emp/search',
        'absensi/search',
		'input_emp/input',
		'view_emp/search',
        'holiday/input',
        'editGPHRD/update',
        'editGPPMO/update',
        'editGPUNIT/update',
        'givenpointhrd/input',
        'givenpointpmo/input',
        'givenpointunit/input',
        'editMandaysProject/view',
        'editMandaysProject/update',
        'edit_single_mndyproject/view',
        'edit_project/view',
        'edit_project/update',
        'newcase/search',
        'newcase/input',
    ];

    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        // If request is an ajax request, then check to see if token matches token provider in
        // the header. This way, we can use CSRF protection in ajax requests also.
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');

        return $request->session()->token() == $token;
    }

}
