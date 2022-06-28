<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Ollie landing page.">
    <meta name="author" content="Devcrud">
    <!-- AJAX Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dynamic content</title>


    <!-- font icons -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/themify-icons/css/themify-icons.css'>

    <!-- owl carousel -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.carousel.css'>
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.theme.default.css'>

    <!-- Bootstrap + Ollie main styles -->
    <link rel="stylesheet" href='{{url("/")}}/assets/css/ollie.css'>

</head>

<body>
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">

                        <div class="card-header">
                            To Change The Content of Template
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                        @endif

                        <div id="success_message"></div>

                        <ul id="saveform_errList"></ul>

                        <div class="card-body">
                            <form action="{{ url('store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="old_password">Editor</label>
                                    <textarea name="editor" id="editor" cols="30" rows="5" class="editor form-control" placeholder="TEXT"></textarea>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="card">
                                                <div class="form-group">
                                                    <label for="new_password">Select Type</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="type">
                                                        <option>Select type that you want to change</option>
                                                        <option value="about_us">About us</option>
                                                        <option value="expertises">Expertises</option>
                                                        <option value="our_product">Our Products</option>
                                                        <option value="testmonials">Testmonials</option>
                                                        <option value="our_blog">Our Blog</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="heading">Heading</label>
                                                    <input type="text" name="heading" class="heading form-control" id="heading">
                                                </div>
                                                <div class="form-group">
                                                    <label for="details">Details</label>
                                                    <textarea name="topic_details" id="topic_details" cols="30" rows="5" class="topic_details form-control" placeholder="Topic details"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Choose Profile Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="temp_image custom-file-input" name="temp_image" id="temp_image">
                                                            <label class="custom-file-label" for="exampleInputFile">IMAGE</label>
                                                            <img id="previewImg1" alt="template image" style="max-width:130px;margin-top:20px;" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="heading">Title</label>
                                                    <input type="text" name="title" class="title form-control" id="title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password">Photo Details</label>
                                                    <textarea name="img_details" id="img_details" cols="30" rows="5" class="img_details form-control" placeholder="Image discription"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- core  -->
    <script src='{{url("/")}}/assets/vendors/jquery/jquery-3.4.1.js'></script>
    <script src='{{url("/")}}/assets/vendors/bootstrap/bootstrap.bundle.js'></script>

    <!-- bootstrap 3 affix -->
    <script src='{{url("/")}}/assets/vendors/bootstrap/bootstrap.affix.js'></script>

    <!-- Owl carousel  -->
    <script src='{{url("/")}}/assets/vendors/owl-carousel/js/owl.carousel.js'></script>


    <!-- Ollie js -->
    <script src='{{url("/")}}/assets/js/Ollie.js'></script>

    <script src={{ asset('ckeditor/ckeditor.js') }}></script>
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open('POST', "{{route('upload',['_token'=>csrf_token() ])}}", true);
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve(response);
                });

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();

                data.append('upload', file);

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send(data);
            }
        }

        // ...

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        // ...

        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.log(error);
            });
    </script>