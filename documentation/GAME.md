#game
This project is using PHP7, the slim framework version 3 and jquery.
## Routes API
This game is using by now only 2 routes :
* GET /
* POST /move
### /move
the application call /move with this informations

    type : POST
    body:{
    "playerUnit":"X",
    "botUnit":"O"
    "boardState":
        [
            ["O","X","O"],
            ["X","",""],
            ["X","O",""]
        ]
    }

and the response is :

    {
    "winner":null,
    "playerWins":false,
    "botWins":false,
    "tiedGame":false,
    "winnerPositions":[],
    "nextMove":[2,2,"O"]
    }

## Game Logic

when a board and the player is send the logic work as follow :
* Determine if the data is valid
* Determine if the game is over (Tie, winner ...)
* Determine if there is more than one move to make
* If the is more than one move to make then find the best move using the makeMove method.
This method use the minMax algorithm to determine the best move.
* Return the best Move and determine if this move finish the game.

If you have any questions

    yohann.payrot@malinshopper.com

