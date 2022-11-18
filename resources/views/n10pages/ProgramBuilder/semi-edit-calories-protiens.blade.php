
<div class="accordion-body">
    <div class="row mt-2">
        <div class="col-4"></div>
        <div class="col-4"> <label for="">Calories</label></div>
        <div class="col-4"> <label for="">Proteins</label></div>
    </div>
    @for ($j = $week_start; $j <= $week_end; $j++)
        <div class="row mt-2">
            <div class="col-4 mt-3"><label for="week-cal-pro{{ $j }}">Week
                    {{ $j }}</label></div>
            <div class="col-4"> <input type="number" name="week-{{ $j }}-calories"
                    class="form-control" placeholder="Week Calories"></div>
            <div class="col-4"> <input type="number" name="week-{{ $j }}-proteins"
                    class="form-control" placeholder="Week Proteins"></div>
        </div>
    @endfor

