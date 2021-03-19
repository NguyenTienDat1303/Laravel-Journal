@extends('admin.admin_master') @section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact</h2>
        </div>
        <div class="card-body">
            <form
                action=" {{ route('update.contact', $contact -> id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Address</label>
                    <input
                        type="text"
                        class="form-control"
                        id="exampleFormControlInput1"
                        placeholder="About Title"
                        name="address"
                        value="{{ $contact -> address }}"
                    />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input
                        type="text"
                        name="email"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        placeholder="Enter contact address"
                        value="{{ $contact -> email }}"
                    />
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        placeholder="Enter contact phone"
                        value="{{ $contact -> phone }}"
                    />
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
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
