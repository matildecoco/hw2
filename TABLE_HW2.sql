CREATE TABLE users(
    id INTEGER AUTO_INCREMENT UNIQUE,
    nomeUtente VARCHAR(50) PRIMARY KEY,
    nome VARCHAR(50),
    cognome VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(255),
    immagine VARCHAR(255),
    updated_at datetime,
    created_at datetime
);

CREATE TABLE posts(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nomeUtente VARCHAR(50),
    titolo VARCHAR(255),
    URL VARCHAR (255),
    dataPost DATETIME,    
    index idx_nomeUtente(nomeUtente),
    FOREIGN KEY(nomeUtente) REFERENCES users(nomeUtente)
);
  

CREATE TABLE hw2Likes(
    post_id INTEGER,
    nomeUtente VARCHAR(50),
    index idx_post_id(post_id),
    index idx_nomeUtente(nomeUtente),
    FOREIGN KEY(post_id) REFERENCES posts(id),
    FOREIGN KEY(nomeUtente) REFERENCES users(nomeUtente),
    PRIMARY KEY(post_id, nomeUtente)
);

CREATE TABLE followers(
    follower VARCHAR(50),
    following VARCHAR(50),
    index idx_follower(follower),
    index idx_following(following),
    FOREIGN KEY (follower) REFERENCES users(nomeUtente),
    FOREIGN KEY (following) REFERENCES users(nomeUtente),
    PRIMARY KEY(follower, following)

);
