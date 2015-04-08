@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		    <div class="row">
                <form action="/" method="POST" class="form-inline">
                    <label for="language">Language: </label>
                    <select name="language" id="language" class="form-control">
                        <option value="PHP">PHP</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="CSS">CSS</option>
                        <option value="Python">Python</option>
                    </select>

                    <input type="submit" class="form-control" value="Submit"/>
                </form>
                <hr/>
            </div>

            <div class="row">
                @if($repos)
                    <table class="table table-hover">
                        <tr>
                            @foreach($tableHeader as $item)
                                <th>{{$item->getName()}}</th>
                            @endforeach
                        </tr>
                        @foreach($repos as $repo)
                            <tr>
                                @foreach($repo->getF() as $item)
                                    <td>{{$item->getV()}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>

		</div>
	</div>
</div>
@endsection
