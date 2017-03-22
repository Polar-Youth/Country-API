@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="jumbotron">
                    <h2>Open country information.</h2>

                    <p class="lead">
                        With this tools we want to try. Give access to everyone who need information.
                        About countries. And we also provide this information into API form.
                    </p>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-info-circle" aria-hidden="true"></span>
                        API Documentation
                    </div>

                    <div class="panel-body">
                        If you want the use the data in your future project. U can with our extensive
                        documented api. You can <a href="">read</a> the documentation here. And lets started with
                        your project.
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-globe" aria-hidden="true"></span>
                        Web interface
                    </div>

                    <div class="panel-body">
                        For the non developers under the community we also provide the info in a web interface.
                        Where u can find the needed country. And read the data u need.
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                        Register as volunteer.
                    </div>

                    <div class="panel-body">
                        This project needs also volunteers for containing the correctness of the data.
                        So a select goup of people will manage this. And maybe you want to be one of them.
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection