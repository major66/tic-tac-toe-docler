$(
    function ()
    {
        /**
         * @returns {string}
         */
        var getBotUnit = function ()
        {
            return $('.player-unit-selected').html() == 'X' ? 'O' : 'X';
        };

        /**
         * @returns {string}
         */
        var getPlayerUnit = function ()
        {
            return $('.player-unit-selected').html();
        };

        /**
         *
         * @param className
         */
        var incrementPoints = function (className)
        {
            var botPoints = new Number($(className).html());

            $(className).html(botPoints + 1);
        };

        var resetBoard = function ()
        {
            $('.position').html('');
            $('.position').removeClass('winner-game');
            $('.position').removeClass('tied-game');
            $('.position').addClass('active');
            $('.status-message').fadeOut();
            $('.player-unit').removeAttr('disabled');
        }

        /**
         * @param message
         */
        var showMessage = function (message)
        {
            $('.status-message .message').html(message);
            $('.status-message').fadeIn();
        };

        /**
         * @param xPosition
         * @param yPosition
         * @param playerUnit
         */
        var markBoard = function (xPosition, yPosition, playerUnit)
        {
            $('.p-' + yPosition + '-' + xPosition).html(playerUnit);
        }

        /**
         * @param winnerPositions
         */
        var handleWinnerPositions = function (winnerPositions)
        {
            for (var i in winnerPositions) {
                var x = winnerPositions[i][0];
                var y = winnerPositions[i][1];

                $('.p-' + x + '-' + y).addClass('winner-game');
            }
        };

        /**
         * @param xPosition
         * @param yPosition
         * @param unit
         * @returns {*[]}
         */
        var makeMove = function (xPosition, yPosition, unit)
        {
            markBoard(xPosition, yPosition, unit);

            return [
                [
                    $('.p-0-0').html(),
                    $('.p-1-0').html(),
                    $('.p-2-0').html()
                ],
                [
                    $('.p-0-1').html(),
                    $('.p-1-1').html(),
                    $('.p-2-1').html()
                ],
                [
                    $('.p-0-2').html(),
                    $('.p-1-2').html(),
                    $('.p-2-2').html()
                ]
            ];
        };

        /**
         * @param data
         * @param isPlayerMove
         */
        var handleMoveResponse = function (data, xPosition, yPosition, isPlayerMove)
        {
            var hasNextMove = data.nextMove !== null && typeof data.nextMove == 'object';
            var hasWinner = data.winnerPositions !== null && typeof data.winnerPositions == "object";

            if (hasWinner) {
                handleWinnerPositions(data.winnerPositions);
            }

            if (data.tiedGame) {
                $('.position').addClass('tied-game');

                return showMessage('Tied game! :|');
            }

            if (data.playerWins) {
                incrementPoints('.user-points');

                return showMessage('Player wins! :)');
            }

            if (data.botWins) {
                incrementPoints('.bot-points');

                return showMessage('Bot wins! :(');
            }

            if (isPlayerMove && hasNextMove) {
                xPosition = data.nextMove[0];
                yPosition = data.nextMove[1];

                markBoard(xPosition, yPosition, getBotUnit());
                submitMove(xPosition, yPosition, getBotUnit(), false);
            }

            if (!isPlayerMove) {
                $('.position').addClass('active');
            }
        };

        /**
         * @param xPosition
         * @param yPosition
         * @param unit
         * @param isPlayerMove
         */
        var submitMove = function (xPosition, yPosition, unit, isPlayerMove)
        {
            var boardState = makeMove(xPosition, yPosition, unit);
            var requestBody = { playerUnit : getPlayerUnit(), boardState : boardState };

            $.ajax(
                {
                    dataType: 'json',
                    method: 'POST',
                    url: '/move',
                    data: JSON.stringify(requestBody)
                }
            ).done(
                function(data)
                {
                    handleMoveResponse(data, xPosition, yPosition, isPlayerMove);
                }
            );
        };

        $('.position').on(
            'click',
            function (event)
            {
                event.preventDefault();

                var button = $(this);
                var xPosition = button.data('x');
                var yPosition = button.data('y');
                var isPlayerMove = true;
                var isInactive = !button.is('.active');

                if (button.html().length > 0 || isInactive) {
                    return;
                }

                $('.position').removeClass('active');
                $('.player-unit').attr('disabled', 'disabled');

                submitMove(xPosition, yPosition, getPlayerUnit(), isPlayerMove);
            }
        );

        $('.status-message button').on(
            'click',
            function (event)
            {
                event.preventDefault();

                resetBoard();
            }
        );

        $('.player-unit').on(
            'click',
            function ()
            {
                var button = $(this);

                $('.player-unit-selected').html(button.html());
                $('.player-unit').removeClass('btn-success');
                $('.player-unit').addClass('btn-default');
                $('.player-unit').attr('disabled', 'disabled');

                button.removeClass('btn-default');
                button.addClass('btn-success');
            }
        );
    }
);