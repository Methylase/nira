@extends('layouts.admin')
  @section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body" id="blog-body">
                                        <p class="card-title">Blog Post List</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="list-properties" class="display expandable-table text-center" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Type</th>
                                                                <th>Title</th>
                                                                <th>Description</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i= 1;?>
                                                            @foreach ($blogs as $blog )
                                                            <tr>
                    
                                                                <td class="pl-0 pb-0"><?= $i ?> </td>
                                                                <td class="pl-0 pb-0"><?= $blog->type ?> </td>
                                                                <td class="pl-0 pb-0"><?= $blog->title ?> </td>
                                                                <td class="pl-0 pb-0"><?= $blog->description ?> </td>
                                                                <td class="pl-0 pb-0">
                                                                    <?php if( $blog->status == NULL): ?>
                                                                        <span  class="bg-warning rounded p-2">Active</span> 
                                                                    <?php elseif($blog->status !=NULL): ?>
                                                                        <span class="bg-danger rounded p-2">Inactive</span>
                                                                    <?php endif ?>
                                                                </td>
                                                                <td>
                                                                    <a href="/edit-blog-post/{{$blog->id}}" class="btn" title="Edit"><span class="fa fa-edit h3"></span></a>                                         
                                                                    <a href="" class="btn deleteBlog"  id='del {{$blog->id}}' data-title="Delete" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash h3" title="Delete"></span></a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;?>
                                                            @endforeach
                                                        </tbody>                 
                                                    </table>

                                                    <!-- modal for delete staff -->
                                                    <div class="modal col-md-10 offset-md-2  col-sm-10 offset-sm-2 " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">                  
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title" id="Heading">Delete this blog post</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="alert alert-danger  format"><span class="fa fa-warning text-danger"></span> Are you sure you want to delete this blog post?</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button  class="btn btn-success del_blog"><span class="fa fa-check-circle"></span> Yes</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> No</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of modal for delete property -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection