@if ($question_type == 'Enumeration')
    <label for="">Question</label>
    <textarea name="question" class="form-control" required></textarea>
    <input type="hidden" name="question_type" value="{{ $question_type }}">
    <br />
    @for ($i = 0; $i < $loop_number; $i++)
        {{ $i + 1 }}.<input class="form-control" name="answer[]" required> <br />
    @endfor
@elseif($question_type == 'Multitple Choice')
    <label for="">Question</label>
    <textarea name="question" class="form-control" required></textarea>
    <br />
    <label>Answer</label>
    <select name="answer" class="form-control" required>
        <option value="" default>Set Answer</option>
        <option value="choice_a">Choice A</option>
        <option value="choice_b">Choice B</option>
        <option value="choice_c">Choice C</option>
        <option value="choice_d">Choice D</option>
    </select>
    <hr>
    <label>Choice A</label>
    <input type="text" required name="choice_a" class="form-control">

    <label>Choice B</label>
    <input type="text" required name="choice_b" class="form-control">

    <label>Choice C</label>
    <input type="text" required name="choice_c" class="form-control">

    <label>Choice D</label>
    <input type="text" required name="choice_d" class="form-control">

    <input type="hidden" name="question_type" value="{{ $question_type }}">
    {{-- <input type="hidden" value="{{ $course_id }}" name="course_id">
    <input type="hidden" value="{{ $number_of_exams - 1 }}" name="number_of_exams"> --}}
@elseif($question_type == 'Identification')
    <label for="">Question</label>
    <textarea name="question" class="form-control" required></textarea>
    <br />
    <label>Answer</label>
    <input type="text" name="answer" class="form-control" required>
    <input type="hidden" name="question_type" value="{{ $question_type }}">
@elseif($question_type == 'Matching Type')
    <div class="row">
        <div class="col-md-6">
            @for ($i = 0; $i < $loop_number; $i++)
                {{ $i + 1 }}.<input class="form-control" name="question[]" required> <br />
                Answer.<input type="text" class="form-control" name="answer[]">
            @endfor
        </div>
        <div class="col-md-6">
            @for ($i = 0; $i < $loop_number+3; $i++)
                {{ $i + 1 }}.<input class="form-control" name="choices[]"> <br />
            @endfor
        </div>
    </div>
@endif
