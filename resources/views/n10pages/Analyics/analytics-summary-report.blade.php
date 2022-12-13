@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')
<style>
    table, th, td {
  border: 1px solid !important;
}
</style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="analytics-weeks"></th>
                                    @foreach ($analytics_weeks as $aw)
                                        <th class="analytics-weeks">W{{ $aw }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="analytics-head">Strength Stimulus</td>
                                    @foreach ($strength_stimulus as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Hypertrophic Stimulus</td>
                                    @foreach ($hypertrophic_stimulus as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Set Volume</td>
                                    @foreach ($set_volume as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Intensity</td>
                                    @foreach ($intensity as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Sleep</td>
                                    @foreach ($sleep as $ss)
                                        @if ($ss > 80)
                                            <td style="color: green">{{ $ss }}%</td>
                                        @else
                                            <td style="color: red">{{ $ss }}%</td>
                                        @endif
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Motivation</td>
                                    @foreach ($motivation as $ss)
                                        @if ($ss > 80)
                                            <td style="color: green">{{ $ss }}%</td>
                                        @else
                                            <td style="color: red">{{ $ss }}%</td>
                                        @endif
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Stress</td>
                                    @foreach ($stress as $ss)
                                        @if ($ss > 80)
                                            <td style="color: green">{{ $ss }}%</td>
                                        @else
                                            <td style="color: red">{{ $ss }}%</td>
                                        @endif
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Calorie</td>
                                    @foreach ($calories as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="analytics-head">Calorie Compliance</td>
                                    @foreach ($calorie_compliance as $ss)
                                        @if ($ss > 80)
                                            <td style="color: green">{{ $ss }}%</td>
                                        @else
                                            <td style="color: red">{{ $ss }}%</td>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="analytics-head">Protein</td>
                                    @foreach ($proteins as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="analytics-head">Protein Compliance</td>
                                    @foreach ($protein_compliance as $ss)
                                        @if ($ss > 80)
                                            <td style="color: green">{{ $ss }}%</td>
                                        @else
                                            <td style="color: red">{{ $ss }}%</td>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="analytics-head">Body Weight</td>
                                    @foreach ($body_weight as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="analytics-head">Waist</td>
                                    @foreach ($waist as $ss)
                                        <td>{{ $ss }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="analytics-head">Bodyfat</td>
                                    @foreach ($bodyfat as $ss)
                                        @if ($ss > 80)
                                            <td style="color: green">{{ $ss }}%</td>
                                        @else
                                            <td style="color: red">{{ $ss }}%</td>
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('scripts')
@endsection
