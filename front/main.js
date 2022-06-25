async function getPosts(){
    let res = await fetch('https://jsonplaceholder.typicode.com/posts');
    let posts = await res.json();
    posts.forEach(post => {
        document.querySelector('ul').innerHTML += `
            <li>
                <h2>${post.title}</h2>
                <p>${post.body}</p>
                <a href="#"><button>Btn</button></a>
            </li>
        `
    });
}
getPosts();