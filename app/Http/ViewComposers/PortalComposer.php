<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Portal;
use Modules\OrganizationManagement\Entities\Outlet;

use Share;
use Carbon\carbon;
use Modules\CatalogManagement\Entities\Cause;
use Modules\CatalogManagement\Entities\Expertise;
use Modules\OrganizationManagement\Entities\Industry;

class PortalComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $subdomain = 'portal';
        $headoffices = Outlet::where('outlet_type', 'Office')->get();
        $servedindustries = Industry::active()->get();
        $expertises = Expertise::active()->get();
        $shared = Share::currentPage()
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp();
        $portal = Portal::with('Organization')->where('subdomain', $subdomain)->first();
        $view->with('portal', $portal)
            ->with('headoffices', $headoffices)
            ->with('expertises', $expertises)
            ->with('servedindustries', $servedindustries)
            ->with('shared', $shared);
        }
}
