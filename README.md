# PHP MySQL CRUD Blog Application

## What Has Been Implemented

### 🔐 User Authentication
- User registration with fields: Full Name, Email, Username, Password
- Passwords are securely hashed using `password_hash()`
- Login form verifies credentials using `password_verify()`
- Sessions are used to manage login/logout states
- Access to CRUD operations is restricted to authenticated users

### 📝 Post Management (CRUD Operations)
- **Create**:  
  Users can create a post with a title and content using a clean form interface.  
  After submission, the post is stored in the `posts` table and a success message is shown.

- **Read**:  
  All posts are displayed in a styled layout, ordered by creation date.  
  Each post displays its title, content, and the date it was created.  
  Posts have options to update or delete them.

- **Update**:  
  Users can update any post.  
  All posts are shown with editable fields and an "Update" button per post.  
  A confirmation message is shown after successful update.

- **Delete**:  
  All posts are listed with a "Delete" button per post.  
  A confirmation prompt is displayed before deletion.  
  A message is shown after successful deletion.

### 🗃️ Database
- MySQL database named `blog`
- Two tables:
  - `users`: stores user credentials and profile info
  - `posts`: stores blog post data with timestamp

### 💅 Styling
- Inline CSS used in each PHP file for simplicity
- Modern and light UI with:
  - Styled input fields
  - Buttons for actions
  - Consistent color scheme across pages

### 🔄 Navigation
- Dashboard (`main.php`) provides buttons to:
  - Create Post
  - Read Post
  - Update Post
  - Delete Post
  - Logout

