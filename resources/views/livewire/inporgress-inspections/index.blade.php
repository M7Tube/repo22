<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">In Progress Inspection Table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    desc</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    location</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    doc_no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    is complated</th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ipis as $ipi)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $ipi->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $ipi->desc }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $ipi->location }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $ipi->date }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $ipi->doc_no }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $ipi->is_complated == 0 ? __('No') : __('Yes') }}
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button
                                            class="text-secondary btn btn-outline-success font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user"
                                            wire:click.prevent="makeComplate({{ $ipi->IPI_id }})">
                                            Make Complate
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {!! $ipis->links() !!}
</div>
