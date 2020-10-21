@extends('layouts.app', ['pageSlug' => 'dashboard'])
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="card-title d-flex justify-content-end">DASHBOARD</h4>
                            <h2 class="card-title">My Expenses</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table tablesorter" id="table_dashboard">
                                <thead class="text-primary">
                                <tr>
                                    <th>Expenses Categories</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div style="color: #2dce89" id="piechart"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>


@endsection

