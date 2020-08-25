@extends('layouts.admin')

@section('content')
    <h1>Δημοσιεύσεις</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('posts.create')}}">
            <button class="btn btn-info w-100">Εισαγωγή δημοσίευσης</button>
        </a>
    </div>

    @if(count($posts)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Τίτλος</th>
                <th scope="col">Χρήστης</th>
                <th scope="col">Ημ/νία</th>
                <th scope="col">Έγκριση</th>
                <th scope="col">Ενέργεια</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name ?? 'Κανένας'}}</td>
                    <td>{{$post->created_at->diffForHumans() ?? ''}}</td>
                    <td>{{$post->approved==1 ? 'Ενεργό' : 'Ανενεργό'}}</td>

                    <td>
                        <form method="POST" action="{{route('posts.destroy', $post->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <div class="app">
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Είσαι σίγουρος για την διαγραφή;')">
                                    Διαγραφή
                                </button>
                            </div>

                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $posts->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν δημοσιεύσεις</h1>
    @endif
@endsection

@section('scripts')

    <script>
		new Vue({
			el: '#app',
			data: {
				matches: matches.data,
				isSaved: {}
			},
			created: function () { // Set first values to this.isSaved array
				for (let key in this.matches) {
					Vue.set(this.isSaved, key, true);
				}
			},
			methods: {
				postData(key) {
					let myData = {
						id: this.matches[key].id,
						first_team_score: this.matches[key].first_team_score,
						first_team_score_1: this.matches[key].first_team_score_1,
						first_team_score_2: this.matches[key].first_team_score_2,
						first_team_score_3: this.matches[key].first_team_score_3,
						first_team_score_4: this.matches[key].first_team_score_4,
						first_team_score_5: this.matches[key].first_team_score_5,
						second_team_score: this.matches[key].second_team_score,
						second_team_score_1: this.matches[key].second_team_score_1,
						second_team_score_2: this.matches[key].second_team_score_2,
						second_team_score_3: this.matches[key].second_team_score_3,
						second_team_score_4: this.matches[key].second_team_score_4,
						second_team_score_5: this.matches[key].second_team_score_5
					};
					axios.patch('/api/match', myData)
						.then(response => {
							Vue.set(this.isSaved, key, true);
						})
						.catch(e => console.log(e));
				},
				changingScore(key) {
					Vue.set(this.isSaved, key, false);
				}
			}
		});
    </script>

@endsection
