@extends('frontpage')

@section('content')
    <template id="column-template">
        <div class="lane-column">
            <div class="lane-title"><input type="text" value=""/></div>
            <div class="lane-block"></div>
            <br/>
            <button data-action="add-card" class="btn btn-primary">Add datapoint</button>
        </div>
    </template>

    <template id="item-template">
        <div class="lane-item">
            <div class="card">
                <div class="card-content">
                    <span class="card-title" data-holder="title"></span>
                    <div data-holder="file"></div>
                    <p data-holder="content"></p>

                    <div style="margin-top: 5px;">
                        <span class="activator btn" data-card-action="edit">Edit</span>
                        <button data-card-action="delete" class="btn btn-danger pink darken-4">Delete</button>
                    </div>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4" data-card-action="close"><i
                                class="material-icons right">close</i></span>
                    <div class="input-field">
                        <label>Title</label>
                        <input type="text" name="title"/>
                    </div>
                    <div>
                        <label>File:</label>
                        <input type="file" name="file"/>
                    </div>
                    <br/>
                    <div>
                        <label>Content</label>
                        <textarea name="content" placeholder="Content"
                                  style="height: 125px; border: 1px solid #eee; padding: 4px;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <div class="action-buttons">
        <button data-action="add-column" class="btn btn-primary">Add round</button>
    </div>

    <div class="swimlanes">
        <div class="swimlanes-container"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css"/>

    <style>
        .action-buttons {
            margin: 10px 0;
        }

        .swimlanes {
            margin: 15px 0 90px 0;
            min-height: 600px;
            display: block;
            width: 100%;
            overflow: auto;
        }

        .lane-column {
            width: 310px;
            margin-bottom: 10px;
            margin-right: 10px;
            display: block;
            float: left;
        }

        .lane-title {
            padding: 15px 25px;
            border-bottom: 2px solid #ccc;
            background: #f0f0f0;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        .lane-block {
            background: #eee;
            min-height: 700px;
            display: block;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            padding: 15px;
        }

        .lane-title input {
            border: none !important;
            font-size: 11px !important;
            margin: 0 !important;
            padding: 2px !important;
            height: auto !important;
        }

        .card.opened {
            height: 350px;
        }
    </style>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var drake;

        function initializeDragDrop() {
            if (drake) {
                // Destroy any existing drag & drop events if already initialized
                drake.destroy();
            }

            // Initialize drag & drop functionality
            drake = dragula({
                containers: $('.lane-block').toArray(),
                moves: function (el, source, handle, sibling) {
                    return $(el).hasClass('lane-item');
                }
            });

            drake.on('drop', function (el, source) {
                var lane = $(source).parents('.lane-column');
                var laneTitle = lane.find('.lane-title input').val();

                var card = $(el);
                var roundId = card.parents('.lane-column').data('id');
                var newRoundId = lane.data('id');
                var datapointId = card.data('id');

                var title = card.find('[data-holder="title"]').text();
                var content = card.find('[data-holder="content"]').text();

                // TODO Update with real data
                $.ajax({
                    url: '/datapoint/' + roundId + '/update/' + datapointId,
                    method: 'patch',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({
                        title: title,
                        text: content,
                        point_pos_lat: 0,
                        point_pos_long: 0,
                        is_direction: false,
                        round_id: newRoundId
                    }),
                    success: function (response) {
                        M.toast({html: '<span>Datapoint moved to round <strong>' + laneTitle + '</strong></span>'});
                    }
                });
            });
        }

        function resizeColumnContainer() {
            // Get width + padding + margin
            var width = $('.swimlanes .lane-column:first').outerWidth(true);

            // Get number of lanes
            var lanes = $('.swimlanes .lane-column').length;

            // Add the total width of a column multiplied with the number of columns to the container
            $('.swimlanes-container').width(width * lanes);
        }

        function loadImageUrl(files, container) {
            if (files && files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var url = e.target.result;
                    container.html('<img width="100%" src="' + url + '"/>');
                };

                reader.readAsDataURL(files[0]);
            }
        }

        /**
         * Add new round
         * @param title
         * @param id
         */
        function addLane(title, id) {
            var template = $($('#column-template').html());
            var container = $('.swimlanes-container');
            var laneTitleInput = template.find('.lane-title input');

            // Add blur event on the input so we can save the data for example and show a toast
            laneTitleInput.on('blur', function (e) {
                // TODO Save new lane title into the database
                M.toast({html: '<span>Round title updated</span>'})
            });

            if (id) {
                template.attr('data-id', id);
            } else {
                // TODO Replace with real data
                $.ajax({
                    url: "{{ route('createRound') }}",
                    method: 'post',
                    data: JSON.stringify({
                        title: 'New round',
                        author: 'john',
                        description: 'Description',
                        genre: 'Genre',
                        image_id: 0,
                        city: 'City',
                        start_pos_lat: 'Latitude',
                        start_pos_long: 'Longitude',
                        language: 'en'
                    }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (response) {
                        template.attr('data-id', response.id);
                        template.find('.lane-title input').val(response.title);
                        console.log('response:', response);
                    }
                });
            }

            // Add the column template to the container
            container.append(template);

            if (title === undefined) {
                // Focus on the title input
                template.find('.lane-title input').focus();

                M.toast({html: '<span>New Round added</span>'});
            } else {
                template.find('.lane-title input').val(title);
            }

            resizeColumnContainer();
            initializeDragDrop();
        }

        /**
         * Add new datapoint
         * @param laneId
         * @param title
         * @param content
         */
        function addCard(laneId, title, content, cardId) {
            var template = $($('#item-template').html());
            var parent = $('.swimlanes').find('.lane-column[data-id="' + laneId + '"]');
            var container = parent.find('.lane-block');

            if (title === undefined && content === undefined) {
                // Create new datapoint in database
                // TODO Change with real data
                title = 'New datapoint';
                content = 'Datapoint description'

                $.ajax({
                    url: '/datapoint/' + laneId + '/create',
                    method: 'post',
                    data: JSON.stringify({
                        title: title,
                        text: content,
                        point_pos_lat: 0,
                        point_pos_long: 0,
                        is_direction: false
                    }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (response) {
                        console.log('response:', response);
                    }
                });
            }

            if (cardId) {
                template.attr('data-id', cardId);
            }

            if (title) {
                template.find('[data-holder="title"]').html(title);
                template.find('input[name="title"]').val(title);
            }

            if (content) {
                template.find('[data-holder="content"]').html(content);
                template.find('textarea[name="content"]').val(content);
            }

            // Add the new card to the column
            container.append(template);
        }

        $(document).ready(function () {
            resizeColumnContainer();
            initializeDragDrop();

            // Listen for click events on the `add column` button
            $('button[data-action="add-column"]').on('click', function () {
                addLane();
            });

            // Listed for click events for any new column `add card` button
            $('.swimlanes-container').on('click', '.lane-column button[data-action="add-card"]', function () {
                var laneId = $(this).parents('.lane-column').data('id');
                addCard(laneId);
            });

            $('.swimlanes-container').on('click', '.card [data-card-action="edit"]', function () {
                var card = $(this).parents('.card');
                card.addClass('opened');
            });

            $('.swimlanes-container').on('click', '.card [data-card-action="delete"]', function () {
                var card = $(this).parents('.card');

                var roundId = $(this).parents('.lane-column').data('id');
                var datapointId = $(this).parents('.lane-item').data('id');

                $.ajax({
                    url: '/datapoint/' + roundId + '/delete/' + datapointId,
                    method: 'delete',
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (response) {
                        card.remove();
                        M.toast({html: '<span>Datapoint removed</span>'})
                    }
                });
            });

            $('.swimlanes-container').on('click', '.card [data-card-action="close"]', function () {
                var card = $(this).parents('.card');
                var title = card.find('input[name="title"]').val();
                var file = card.find('input[name="file"]').prop('files');
                var content = card.find('textarea[name="content"]').val();
                card.removeClass('opened');

                card.find('[data-holder="title"]').html(title);
                card.find('[data-holder="content"]').html(content);
                loadImageUrl(file, card.find('[data-holder="file"]'));

                var roundId = $(this).parents('.lane-column').data('id');
                var datapointId = $(this).parents('.lane-item').data('id');

                $.ajax({
                    url: '/datapoint/' + roundId + '/update/' + datapointId,
                    method: 'patch',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({
                        title: title,
                        text: content,
                        point_pos_lat: 0,
                        point_pos_long: 0,
                        is_direction: false
                    }),
                    success: function (response) {
                        M.toast({html: '<span>Datapoint updated</span>'})
                    }
                });
            });


            @foreach($rounds as $round)
            addLane('{{$round->title}}', {{ $round->id }});
            @foreach($round->datapoints as $datapoint)
            addCard({{ $round->id }}, '{{ $datapoint->title }}', '{{ $datapoint->text }}', {{ $datapoint->id }});
            @endforeach
            @endforeach
        });
    </script>
@endsection
