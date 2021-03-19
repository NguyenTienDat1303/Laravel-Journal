@extends('admin.admin_master') @section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Slider</h2>
        </div>
        <div class="card-body">
            <form
                action=" {{ route('update.slider', $slider -> id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Slider Title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="exampleFormControlInput1"
                        placeholder="Slider Title"
                        name="title"
                        value="{{ $slider -> title }}"
                    />
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                        name="description"
                    >{{ $slider -> description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input
                        type="file"
                        class="form-control-file"
                        id="exampleFormControlFile1"
                        name="image"
                    />
                </div>
                <div class="form-group">
                    <img
                        style="width: 50%;"
                        src="{{ asset($slider -> image) }}"
                        alt=""
                    />
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
