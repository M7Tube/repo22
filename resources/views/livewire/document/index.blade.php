<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Documents</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Doc.No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Date</th>
                                <th class="text-secondary opacity-7">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($docs as $doc)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $doc->docNo ?? 0 }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $doc->doc ?? __('Empty') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $doc->created_at ?? __('Empty') }}
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="text-secondary btn btn-outline-success font-weight-bold text-xs"
                                            wire:click.prevent="download('{{ $doc->doc }}')">
                                            Dowmload
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <button class="text-secondary btn btn-outline-success font-weight-bold text-xs w-50"
                wire:click.prevent="downloadAll()">
                Dowmload All
            </button>
        </div>

    </div>
    {!! $docs->links() !!}
</div>
