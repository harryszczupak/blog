import { json } from 'react-router-dom';
import BlogList from '../components/BlogList';
import { useRouteLoaderData } from 'react-router-dom';
const BlogEntries = () => {
	const data = useRouteLoaderData('entries_loader');
	
	return <BlogList data={data} />;
};

export async function loader() {
	const response = await fetch(`http://localhost/blog_api/get_entry.php`);
	if (!response.ok) {
		throw json({ message: 'Could not fetch data' }, { status: 500 });
	}
	const data = await response.json();
	if (data.length === 0) {
		throw json({ message: 'Could not find any entries' }, { status: 404 });
	}
	return data;
}
export default BlogEntries;
