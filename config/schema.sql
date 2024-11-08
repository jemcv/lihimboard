-- Database: lihimboard

-- Table to store categories
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Table to store posts
CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    category_id INT, -- Foreign key to link category
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

-- Table to store comments
CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);

ALTER TABLE posts ADD COLUMN tripcode VARCHAR(255) NULL;

-- Insert additional sample categories
INSERT INTO categories (name) VALUES ('💬 General Discussion');
INSERT INTO categories (name) VALUES ('💻 Technology & Programming');
INSERT INTO categories (name) VALUES ('📚 Literature & Writing');
INSERT INTO categories (name) VALUES ('🚀 Science & Space');
INSERT INTO categories (name) VALUES ('🧠 Mind & Philosophy');

-- Other sample categories
INSERT INTO categories (name) VALUES ('🎨 Art & Design');
INSERT INTO categories (name) VALUES ('📷 Photography');
INSERT INTO categories (name) VALUES ('🎮 Gaming');
INSERT INTO categories (name) VALUES ('🎶 Music');
INSERT INTO categories (name) VALUES ('🎥 Movies & TV');
INSERT INTO categories (name) VALUES ('🛠️ DIY & Crafts');
INSERT INTO categories (name) VALUES ('🌍 Travel & Nature');
INSERT INTO categories (name) VALUES ('🍜 Food & Cooking');
INSERT INTO categories (name) VALUES ('🗞️ News & Current Events');
INSERT INTO categories (name) VALUES ('🕵️‍♂️ Mystery/Conspiracies');
INSERT INTO categories (name) VALUES ('👗 Fashion & Style');

-- Insert sample comments
INSERT INTO comments (post_id, comment_text) VALUES
(1, "This is a great introduction to web development!"),
(1, "Learned a lot from this post, thanks!"),
(2, "Wonderful painting techniques, I can't wait to try them."),
(3, "I've been meaning to play some indie games, this list is perfect."),
(4, "Fascinating insights into the future of AI."),
(5, "These DIY ideas are exactly what I needed for my home."),
(5, "Awesome post, super helpful!");

-- My own posts from the example
INSERT INTO posts (post_id, title, content, image_url, category_id, created_at, tripcode) VALUES 
(1, 'Fyodor Dostoevsky', 'Fyodor Mikhailovich Dostoevsky, sometimes transliterated as Dostoyevsky, was a Russian novelist, short story writer, essayist and journalist.', '/uploads/fyodor-dostoevsky.jpg', 1, '2024-11-05', 'hhMU0speO6'),
(2, 'Notes from Underground', 'Notes from Underground is a novella by Fyodor Dostoevsky first published in the journal Epoch in 1864. It is a first-person narrative in the form of a "confession".', '/uploads/notes-from-underground.jpg', 2, '2024-11-05', 'hhMU0speO6');

-- Other sample posts
INSERT INTO posts (title, content, image_url, category_id) VALUES
("Mastering JavaScript", "Learn the ins and outs of JavaScript, from basic to advanced...", "https://picsum.photos/id/101/450/320.jpg", 1),
("Introduction to Graphic Design", "This post explores the fundamentals of graphic design...", "https://picsum.photos/id/102/450/320.jpg", 2),
("10 Best Hiking Trails", "Discover the best trails for hiking around the world...", "https://picsum.photos/id/103/450/320.jpg", 3),
("Guide to Building Your Own PC", "Step-by-step guide to building a custom PC...", "https://picsum.photos/id/104/450/320.jpg", 4),
("Interior Design Trends of 2024", "Explore the latest trends in home interior design...", "https://picsum.photos/id/100/450/320.jpg", 5),

("Web Security Essentials", "A comprehensive guide to securing your web applications...", "https://picsum.photos/id/106/450/320.jpg", 1),
("Photography for Beginners", "Tips and tricks to improve your photography skills...", "https://picsum.photos/id/107/450/320.jpg", 2),
("Camping Gear Checklist", "Ensure you have all the essentials for your next camping trip...", "https://picsum.photos/id/108/450/320.jpg", 3),
("Exploring Virtual Reality", "Learn how VR is changing the way we interact with technology...", "https://picsum.photos/id/109/450/320.jpg", 4),
("Simple Gardening Tips", "Grow your own plants with these beginner-friendly gardening tips...", "https://picsum.photos/id/110/450/320.jpg", 5),

("Understanding CSS Grid", "A deep dive into CSS Grid and how to create complex layouts...", "https://picsum.photos/id/111/450/320.jpg", 1),
("The Basics of Video Editing", "An introduction to video editing techniques and tools...", "https://picsum.photos/id/112/450/320.jpg", 2),
("Top 10 Destinations for Solo Travel", "Explore the best places to travel solo around the globe...", "https://picsum.photos/id/113/450/320.jpg", 3),
("A Beginner's Guide to Machine Learning", "Understand the fundamentals of machine learning...", "https://picsum.photos/id/114/450/320.jpg", 4),
("Eco-Friendly Home Improvements", "Make your home more sustainable with these eco-friendly tips...", "https://picsum.photos/id/115/450/320.jpg", 5),

("React vs Vue: Which to Choose?", "Comparing React and Vue for modern web development...", "https://picsum.photos/id/116/450/320.jpg", 1),
("Sketching for Beginners", "Start your artistic journey with these basic sketching tips...", "https://picsum.photos/id/117/450/320.jpg", 2),
("Top 5 Music Festivals in 2024", "Get ready for the best music festivals happening in 2024...", "https://picsum.photos/id/118/450/320.jpg", 3),
("Building Mobile Apps with Flutter", "Learn how to build cross-platform apps using Flutter...", "https://picsum.photos/id/119/450/320.jpg", 4),
("Smart Home Automation Ideas", "Upgrade your home with these smart home automation projects...", "https://picsum.photos/id/120/450/320.jpg", 5);
