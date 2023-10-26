<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Distribution</title>
</head>

<body>
    <!-- HTML -->
    <h1>Card Distribution</h1>
    <form method="post" action="">
        <label for="numPeople">Number of People:</label>
        <input type="number" id="numPeople" name="numPeople" min="1" required>
        <input type="submit" value="Distribute Cards">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numPeople = $_POST['numPeople'];

        // Card suits and ranks
        $suits = ["C", "S", "H", "D"];
        $ranks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

        // Create a deck of 52 cards
        $deck = [];
        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $deck[] = $suit . $rank;
            }
        }

        // Shuffle the deck
        shuffle($deck);

        // Calculate number of cards to distribute per person
        $totalCards = count($deck);
        $cardsPerPerson = floor($totalCards / $numPeople);

        // Distribute cards to the specified number of people
        $distributedCards = array_chunk($deck, $cardsPerPerson);

        // Display distributed cards for the specified number of people
        echo "<h2>Distributed Cards:</h2>";
        for ($i = 0; $i < $numPeople; $i++) {
            echo "<p><strong>Person " . ($i + 1) . ":</strong> ";
            if ($i < $totalCards % $numPeople) {
                $extraCard = array_pop($distributedCards[$i]);
                echo implode(", ", $distributedCards[$i]) . ", " . $extraCard;
            } else {
                echo implode(", ", $distributedCards[$i]);
            }
        }
    }
    ?>
</body>

</html>