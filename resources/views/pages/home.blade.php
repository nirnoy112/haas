@extends('layout.main')

@section('content')

    <form method="post" action="{{ route('generate_calender') }}" id="haas_form">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-outline">
                    <label class="form-label" for="haas_year">Choose A Year</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <select class="form-control" name="haas_year" id="haas_year">

                        <?php

                        $starting_year  = 1801;
                        $ending_year    = 2300;

                        for($starting_year; $starting_year <= $ending_year; $starting_year++) {

                        ?>

                            <option value="{{ $starting_year }}" {{($starting_year == (isset($haas_year)? $haas_year : date('Y')) ? ' selected="selected"' : '')}}>{{ $starting_year }}</option>

                        <?php

                        }

                        ?>

                    </select>
                 </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                    <button type="submit" class="btn btn-success btn-block mb-4">Generate Calendar</button>
                 </div>
            </div>
        </div>
    </form>

    @if(isset($haas_year))

        <br>
        <h3 class="text-center">An astrological calendar has been generated for the year <?php echo $haas_year; ?></h3>
        <br>
        <h4 class="text-center">Yearly Statistics (Sorted By Average Daily Score)</h4>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <b>Zodiac Sign</b>
            </div>
            <div class="col-sm-4">
                <b>Total Score</b>
            </div>
            <div class="col-sm-4">
                <b>Average Daily Score</b>
            </div>
        </div>
        <hr>

        @foreach($yearly_stats as $yearly_stat)

        <div class="row">
            <div class="col-sm-4">
                {{ $yearly_stat->zodiac_sign }}
            </div>
            <div class="col-sm-4">
                {{ $yearly_stat->total_score }}
            </div>
            <div class="col-sm-4">
                {{ $yearly_stat->score_per_day }}
            </div>
        </div>

        @endforeach

        <hr>
        <br>
        <form method="post" action="{{ route('display_calender') }}" id="calendar_form">
            @csrf
            <input type="hidden" name="year" value="{{ $haas_year }}">
            <input type="hidden" name="zodiac_sign_id" value="1">
            <button type="submit" class="btn btn-primary btn-block mb-4">Click Here To Explore Full Calendar</button>
        </form>

    @endif

@stop