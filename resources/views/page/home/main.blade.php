<x-office-layout title="Dashboard">

    <div id="kt_content_container" class="container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-8">
            <div class="col-xl-4">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('literatur.index')}}" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotone/Shopping/Cart3.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-file-text" viewBox="0 0 16 16">
                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-inverse-danger fw-bolder fs-2 mb-2 mt-5">Literatur</div>
                        <div class="fw-bold text-inverse-danger fs-7">Kelola seluruh literatur disini</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-4">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('hasilkuis.index')}}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotone/Home/Building.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                              </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-inverse-primary fw-bolder fs-2 mb-2 mt-5">Hasil Kuis</div>
                        <div class="fw-bold text-inverse-primary fs-7">Lihat semua hasil kuis disini</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-4">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('analisisdata.index')}}" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-bar1.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-inverse-success fw-bolder fs-2 mb-2 mt-5">Analisis Data</div>
                        <div class="fw-bold text-inverse-success fs-7">Kelola semua request analisis data disini</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        
        <!--end::Row-->
        <!--begin::Row-->
        
        <!--end::Row-->
        <!--begin::Row-->
        
        <!--end::Row-->
        <!--begin::Row-->
        
        <!--end::Row-->
    </div>
</x-office-layout>