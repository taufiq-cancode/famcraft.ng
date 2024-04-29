@if (auth()->user()->role === "Agent")
    @if($transaction->response !== null)
        <div class="form-group row pb-4">
            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response</label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="inputDefault" value="{{ $transaction->response }}" readonly="readonly">
            </div>
        </div>
    @endif

    @if($transaction->response_text !== null)
        <div class="form-group row pb-4">
            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response Text</label>
            <div class="col-lg-6">
                <textarea class="form-control" id="inputDefault" readonly="readonly">{{ $transaction->response_text }}</textarea>
            </div>
        </div>
    @endif

    @if($transaction->response_pdf !== null)
        <div class="form-group row pb-4">
            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response PDF(s)</label>
            <div class="col-lg-6">
                @foreach(json_decode($transaction->response_pdf) as $pdf)
                    <a href="{{ asset($pdf) }}" download class="mt-1 me-1 btn btn-secondary btn-lg btn-block">Download Slip</a><br>
                @endforeach
            </div>
        </div>
    @endif
@endif

@if (auth()->user()->role === "Administrator")
    <div class="form-group row pb-4">
        <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response</label>
        <div class="col-lg-6">
            <input type="text" class="form-control" id="inputDefault" value="{{ $transaction->response }}" name="response" placeholder="Enter response">
        </div>
    </div>

    <div class="form-group row pb-4">
        <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response Text</label>
        <div class="col-lg-6">
            <textarea class="form-control" id="inputDefault" name="response_text" placeholder="Enter response text">{{ $transaction->response_text }}</textarea>
        </div>
    </div>

    @if($transaction->response_pdf !== null)
        <div class="form-group row pb-4">
            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response PDF(s)</label>
            <div class="col-lg-6">
                @foreach(json_decode($transaction->response_pdf) as $pdf)
                    <div class="col-lg-3">
                        <a href="{{ asset($pdf) }}" download class="mt-1 me-1 btn btn-secondary btn-lg btn-block">Download Slip </a><br>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="form-group row pb-4">
        <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Response Document</label>
        <div class="col-lg-6">
            <input type="file" name="response_pdf[]" class="form-control" id="inputDefault" accept="application/pdf" multiple>
        </div>
    </div>
@endif

<div class="form-group row">
    <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault"></label>
    @if (auth()->user()->role === "Administrator")
        <div class="col-lg-3">
            <button type="submit" class="mt-1 me-1 btn btn-primary btn-lg btn-block">Update</button>
        </div>
    @endif
</div>
