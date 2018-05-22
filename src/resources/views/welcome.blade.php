@extends('master')

@section('content')
    <rounds inline-template>
        <div>

            <section style="padding: 100px">
                <button v-on:click="clickFunction">Rounds</button>
                <div style="padding-bottom: 20px"></div>

                <ul style="list-style-type:disc">

                    <template v-for="round in rounds">
                        <li>
                            <b>@{{ round.title }}</b>
                            <ul>
                                <li>
                                    <b>By: </b>@{{ round.author }}
                                </li>
                                <li>
                                    <b>About: </b>@{{ round.description }}
                                </li>
                                <li>
                                    <b>In: </b>@{{ round.city }}
                                </li>
                            </ul>
                        </li>
                    </template>
                </ul>
                <input type="text" v-model="title">
                @{{ title }}
                <div v-if="title=='hej'">cool</div>

            </section>
        </div>
    </rounds>
@endsection