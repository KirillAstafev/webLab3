function loadMore(offset) {
    console.log(offset);
    const cards = document.querySelector('.main-content');
    const btnLoadMore = document.querySelector('.btn-load-more');

    const url = `/load_more.php?offset=${offset}`;
    fetch(url)
        .then(response => response.text())
        .then(result => {
            cards.removeChild(btnLoadMore);
            cards.insertAdjacentHTML('beforeend', result)
        }).then(() => {
            cards.appendChild(btnLoadMore);
    }).catch(error => console.log(error));
}





