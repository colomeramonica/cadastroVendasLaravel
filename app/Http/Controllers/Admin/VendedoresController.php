<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vendedore\BulkDestroyVendedore;
use App\Http\Requests\Admin\Vendedore\DestroyVendedore;
use App\Http\Requests\Admin\Vendedore\IndexVendedore;
use App\Http\Requests\Admin\Vendedore\StoreVendedore;
use App\Http\Requests\Admin\Vendedore\UpdateVendedore;
use App\Models\Vendedore;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VendedoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexVendedore $request
     * @return array|Factory|View
     */
    public function index(IndexVendedore $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Vendedore::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nome', 'email'],

            // set columns to searchIn
            ['id', 'nome', 'email']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.vendedore.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.vendedore.create');

        return view('admin.vendedore.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVendedore $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreVendedore $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Vendedore
        $vendedore = Vendedore::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vendedores'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vendedores');
    }

    /**
     * Display the specified resource.
     *
     * @param Vendedore $vendedore
     * @throws AuthorizationException
     * @return void
     */
    public function show(Vendedore $vendedore)
    {
        $this->authorize('admin.vendedore.show', $vendedore);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vendedore $vendedore
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Vendedore $vendedore)
    {
        $this->authorize('admin.vendedore.edit', $vendedore);


        return view('admin.vendedore.edit', [
            'vendedore' => $vendedore,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVendedore $request
     * @param Vendedore $vendedore
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateVendedore $request, Vendedore $vendedore)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Vendedore
        $vendedore->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/vendedores'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/vendedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyVendedore $request
     * @param Vendedore $vendedore
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyVendedore $request, Vendedore $vendedore)
    {
        $vendedore->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyVendedore $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyVendedore $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Vendedore::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
