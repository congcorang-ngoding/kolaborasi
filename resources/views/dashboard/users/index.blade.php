<x-dash.layout>
    @slot('title')
        {{ $title }}
    @endslot

    <div class="row mb-5">
        <div class="col-md-6">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>


    <div class="mb-9 d-print-none">
        <div id="projectSummary" data-list='{"valueNames":["id","email", "name", "whatsapp"],"page":6,"pagination":true}'>
            <div class="row justify-content-between mb-4 gx-6 gy-3 align-items-center">
                <div class="col-auto">
                    <h2 class="mb-0">{{ $title }}<span class="fw-normal text-body-tertiary ms-3"></span></h2>
                </div>
                @can('user-create')
                    <div class="col-auto"><a class="btn btn-primary px-5" href="{{ route('users.create') }}"><i
                                class="fa-solid fa-plus me-2"></i>Add new user</a></div>
                @endcan


                <div class="col-auto">
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="exportDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-file-export me-2"></i>Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li>
                                    <form action="{{ route('users.exportPdf') }}" method="get" id="exportPdfForm">
                                        <button class="dropdown-item" type="submit">
                                            Export PDF
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('users.exportExcel') }}" method="get" id="exportExcelForm">
                                        <button class="dropdown-item" type="submit">
                                            Export Excel
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="window.print()">
                                        Export Diagram
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row g-3 justify-content-end align-items-end mb-4">
                <div class="col-12 col-sm-auto">
                    <div class="d-flex align-items-center">
                        <div class="search-box me-3">
                            <form class="position-relative">
                                <input class="form-control search-input search" type="search" placeholder="Search"
                                    aria-label="Search" />
                                <span class="fas fa-search search-box-icon"></span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive scrollbar">
                <table class="table fs-9 mb-0 border-top border-translucent">
                    <thead>
                        <tr>
                            <th class="sort align-middle ps-3" scope="col" data-sort="id" style="width:6%;">ID
                            </th>
                            <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="email">
                                Email
                            </th>
                            <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="name">
                                Name
                            </th>
                            <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="role">
                                Role
                            </th>
                            <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="whatsapp">
                                Whatsapp
                            </th>

                            @canany(['user-edit', 'user-delete'])
                                <th class="sort align-middle text-end" scope="col" style="width:14%;"></th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody class="list" id="project-list-table-body">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($users as $row)
                            <tr class="position-static">
                                <td class="align-middle text-center time white-space-nowrap ps-0 id py-4">
                                    {{ ++$i }}
                                </td>
                                <td class="align-middle time white-space-nowrap ps-0 email py-4">
                                    {{ $row->email }}
                                </td>
                                <td class="align-middle time white-space-nowrap ps-0 name py-4">
                                    {{ $row->name }}
                                </td>
                                <td class="align-middle time white-space-nowrap ps-0 role py-4">
                                    @if (!empty($row->getRoleNames()))
                                        @foreach ($row->getRoleNames() as $v)
                                            {{ $v }}
                                        @endforeach
                                    @endif
                                </td>
                                <td class="align-middle time white-space-nowrap ps-0 whatsapp py-4">
                                    {{ $row->whatsapp }}
                                </td>
                                @canany(['user-edit', 'user-delete'])
                                    <td class="align-middle text-end white-space-nowrap pe-0 action">

                                        <div class="btn-reveal-trigger position-static">
                                            <button
                                                class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end py-2">
                                                @can('user-edit')
                                                    <a class="dropdown-item"
                                                        href="{{ route('users.edit', $row->id) }}">Edit</a>
                                                @endcan
                                                @can('user-delete')
                                                    <div class="dropdown-divider"></div>

                                                    <form method="POST" action="{{ route('users.destroy', $row->id) }}"
                                                        style="display:inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="dropdown-item text-danger">
                                                            Remove</button>
                                                    </form>
                                                @endcan
                                            </div>

                                        </div>
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div
                class="d-flex flex-wrap align-items-center justify-content-between py-3 pe-0 fs-9 border-bottom border-translucent">
                <div class="d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info">
                    </p><a class="fw-semibold" href="#!" data-list-view="*">View all<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a
                        class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="d-flex">
                    <button class="page-link" data-list-pagination="prev"><span
                            class="fas fa-chevron-left"></span></button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next"><span
                            class="fas fa-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>

    @push('footer')
        <script src="{{ asset('backend') }}/assets/js/echarts-example.js"></script>
    @endpush

    @push('chart')
        <script>
            const ctx = document.getElementById('myChart');
            const ctx2 = document.getElementById('myChart2');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($roles as $role)
                            '{{ $role }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah user',
                        data: [
                            '{{ $totalUser }}'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: [
                        @foreach ($roles as $role)
                            '{{ $role }}',
                            'Admin'
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah user',
                        data: [
                            '{{ $totalUser }}', '60'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
</x-dash.layout>
