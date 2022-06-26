let id = null;

async function getPosts(){
    let res = await fetch('http://restapionphp/back/posts');
    let posts = await res.json();
    posts.forEach(post => {
        document.querySelector('ul').innerHTML += `
            <li>
                <h2>${post.title}</h2>
                <p>${post.body}</p>
                <a onclick="selectPost('${post.id}', '${post.title}', '${post.body}')"><button class="update">Редактировать</button></a>
                <a href="index.html" onclick="deletePost(${post.id})"><button class="delete">Удалить</button></a>
            </li>
        `
    });
}

async function addPost(){
    const title = document.getElementById("title").value;
    const body = document.getElementById("body").value;
    let formData = new FormData();
    formData.append('title', title);
    formData.append('body', body);
    const res = await fetch('http://restapionphp/back/posts', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    if(data.status === true){
        await getPosts();
    }
}

async function deletePost(id){
    const res = await fetch(`http://restapionphp/back/posts/${id}`, {
        method: 'DELETE',
    });
    const data = await res.json();
    if(data.status === true){
        await getPosts();
    }
}
async function selectPost(ids, title, body){
    id = ids;
    document.getElementById("title-edit").value = title;
    document.getElementById("body-edit").value = body;
}

async function updatePost(){
    const title = document.getElementById("title-edit").value;
    const body = document.getElementById("body-edit").value;
    const data = {
        title: title,
        body: body
    }
    const res = await fetch(`http://restapionphp/back/posts/${id}`, {
        method: 'PATCH',
        body: JSON.stringify(data)
    });
    let resData = await res.json();
    if(resData.status === true){
        await getPosts();
    }
}

getPosts();