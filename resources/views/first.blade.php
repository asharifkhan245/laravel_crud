<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>

    <h1 class="text-center p-3">Products</h1>
    <div class="container-fluid">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal1">
            Add product
        </button>
    </div>


    <div class="modal " id="myModal1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header ">
                    <h4 class="modal-title ">Add product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                <div class="modal-body">
                    <form method="post" action="/add" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Name</label>
                            <input type="text" class="form-control" id="email" name="name">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">description</label>
                            <input type="text" class="form-control" id="email" name="description">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">price</label>
                            <input type="number" class="form-control" id="email" name="price">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">quantity</label>
                            <input type="number" class="form-control" id="email" name="quantity">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">image</label>
                            <input type="file" class="form-control" id="email" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">TITLE</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">PRICE</th>
                <th scope="col">QUANTITY</th>
                <th scope="col">IMAGE</th>
                <th scope="col">EDIT</th>
                <th scope="col">DELETE</th>

            </tr>
        </thead>
        <tbody>

            <tr>
                @foreach($products as $data)
                <th scope="row">{{$data->id}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->description}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->quantity}}</td>
                <td style="width: 250px;">
                    <div style="width: 25%;"><img src="{{$data->image}}" width="100%"></div>
                </td>

                <td>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal_{{$data->id}}">
                        Edit
                    </button>
                    </div>


                    <div class="modal" id="myModal_{{$data->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Product</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>


                                <div class="modal-body">
                                    <form method="post" action="/edit/{{$data->id}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 mt-3">
                                            <label for="email" class="form-label">Name</label>
                                            <input type="text" class="form-control" value="{{$data->name}}" id="email" name="name">
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="email" class="form-label">description</label>
                                            <input type="text" class="form-control" id="" value="{{$data->description}}" name="description">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="email" class="form-label">price</label>
                                            <input type="number" class="form-control" id="email" value="{{$data->price}}" name="price">
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="email" class="form-label">quantity</label>
                                            <input type="number" class="form-control" id="email" value="{{$data->quantity}}" name="quantity">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="email" class="form-label">image</label>
                                            <input type="file" class="form-control" id="email" value="{{$data->image}}" name="image">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </td>

                <td>
                    <form method="post" action="/delete/{{$data->id}}">
                        @csrf
                        <button type='submit' class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>

</html>