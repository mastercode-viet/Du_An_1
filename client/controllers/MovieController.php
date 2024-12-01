<?php
class MovieController {
    private $movieModel;

    public function __construct($movieModel) {
        $this->movieModel = $movieModel;
    }

    // Hiển thị danh sách phim
    public function showMovies() {
        $movies = $this->movieModel->getMovies();
        include('views/movie_list_view.php');
    }
}
?>
