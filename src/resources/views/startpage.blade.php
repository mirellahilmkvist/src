@extends('master')

@section('content')
    <rounds inline-template>

        <div>
            <h1 class="header center green-text text-lighten-2">Välkommen</h1>

            <div class="row">
                <div class="col s12">
                    <div class="center-align" v-for="round in rounds" v-cloak>

                        <button v-bind:id="round.id" class="btn green col s12 selected"
                                v-on:click="clickFunction(round.id, $event)">
                            @{{ round.title }}
                        </button>
                    </div>
                    <div v-if="seen" class="green lighten-2" v-cloak>
                        <ul class="left-align green lighten-2">
                            <li><b>Author:</B> @{{ oneround.author }}</li>
                            <li><b>Descrition:</b> @{{ oneround.description }}</li>
                            <li><b>Genre:</b> @{{ oneround.genre }}</li>
                            <li><b>Language:</b> @{{ oneround.language }}</li>

                        </ul>
                        <ul class="center-align">
                            <li type="/swimlanes" name="button" class="btn-small green">EDIT</li>

                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <google-map name="roundMap" v-bind:coordinates="datapointCoordinates" inline-template>
                    <div class="google-map" v-bind:id="mapName" style="padding-bottom: 27px" v-bind:class="{'hide': markers.length == 0}"></div>
                </google-map>
            </div>
        </div>

    </rounds>

@endsection
