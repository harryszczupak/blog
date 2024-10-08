import classes from './BlogForm.module.css';

import { Form } from 'react-router-dom';
const BlogForm = () => {
	return (
		<Form method='post' className={classes.form}>
			<h1
				style={{
					color: '#999',
					textAlign: 'center',
					width: '100%',
					margin: '10px',
				}}>
				React Blog
			</h1>
			<div className={classes.inuptsArea}>
				<div className={classes.titlefield}>
					<label>Title</label>
					<input type='text' name='title'></input>
				</div>
				<div className={classes.desc}>
					<label>Description</label>
					<textarea name='description'></textarea>
				</div>
			</div>

			<div className={classes.buttonsArea}>
				<button type='submit' style={{ backgroundColor: '#66c2ff' }}>
					Add
				</button>
			</div>
		</Form>
	);
};
export default BlogForm;
