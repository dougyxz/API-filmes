<?php
    $api_key = 'da77ccfc5dba701a8e770365202fbf23';
    $query = isset($_GET['query']) ? urlencode($_GET['query']) : '';
    $api_url = $query ? "https://api.themoviedb.org/3/search/movie?api_key={$api_key}&language=pt-BR&query={$query}" : "https://api.themoviedb.org/3/movie/popular?api_key={$api_key}&language=pt-BR";

    $response = file_get_contents($api_url);
    $movies = json_decode($response, true)['results'] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes Populares</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="Logo">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="#">Filmes</a></li>
                <li><a href="#">Sobre</a></li>
            </ul>
        </nav>
        <form method="GET" class="search-bar">
            <input type="text" name="query" placeholder="Pesquisar filmes..." value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
            <button class="button-search" type="submit">Buscar</button>
        </form>
    </header>
    <main>
        
        <section class="movies-grid">
            <?php if (empty($movies)): ?>
                <p class="nfe">Nenhum filme encontrado.</p>
            <?php else: ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="movie-card">
                        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                        <h2><?= htmlspecialchars($movie['title']) ?></h2>
                        <p><strong>Descrição:</strong> <?= htmlspecialchars($movie['overview']) ?></p>
                        <p><strong>Data de lançamento:</strong> <?= $movie['release_date'] ?></p>
                        <p><strong>Idioma original:</strong> <?= strtoupper($movie['original_language']) ?></p>
                        <p><strong>Avaliação:</strong> <?= $movie['vote_average'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
