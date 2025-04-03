import React, { useState, useEffect, useContext } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { AuthContext } from '../contexts/AuthContext';

function PostDetail() {
  const { slug } = useParams();
  const [post, setPost] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [relatedPosts, setRelatedPosts] = useState([]);
  const { user } = useContext(AuthContext);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchPost = async () => {
      try {
        setLoading(true);
        const response = await axios.get(`http://localhost:8000/api/posts/${slug}`);
        setPost(response.data);
        
        // Fetch related posts
        const relatedResponse = await axios.get('http://localhost:8000/api/posts?limit=2');
        setRelatedPosts(relatedResponse.data.data.filter(p => p.id !== response.data.id).slice(0, 2));
        
        setLoading(false);
      } catch (error) {
        setError('Failed to fetch post');
        setLoading(false);
      }
    };

    fetchPost();
  }, [slug]);

  if (loading) return <div className="text-center py-10">Loading post...</div>;
  if (error) return <div className="text-center py-10 text-red-600">{error}</div>;
  if (!post) return <div className="text-center py-10">Post not found</div>;

  // Calculate reading time
  const calculateReadingTime = (content) => {
    const wordCount = content.replace(/<[^>]*>/g, '').split(/\s+/).length;
    const readingTime = Math.ceil(wordCount / 200); // Average reading speed: 200 words per minute
    return Math.max(1, readingTime); // Minimum 1 minute
  };

  return (
    <>
      <article className="py-16 bg-white overflow-hidden">
        <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="mb-8">
            <Link to="/blog" className="text-indigo-600 hover:text-indigo-500 flex items-center">
              <svg className="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fillRule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clipRule="evenodd" />
              </svg>
              Back to Posts
            </Link>
          </div>
          
          <div className="text-center">
            <h1 className="text-3xl font-extrabold text-gray-900 sm:text-4xl">{post.title}</h1>
            <div className="mt-4 flex items-center justify-center">
              <div className="flex-shrink-0">
                <span className="sr-only">{post.user.name}</span>
                <div className="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                  <span className="text-white font-medium">{post.user.name.charAt(0)}</span>
                </div>
              </div>
              <div className="ml-3 text-left">
                <p className="text-sm font-medium text-gray-900">{post.user.name}</p>
                <div className="flex space-x-1 text-sm text-gray-500">
                  <time dateTime={post.created_at}>
                    {new Date(post.created_at).toLocaleDateString('en-US', {
                      year: 'numeric',
                      month: 'long',
                      day: 'numeric'
                    })}
                  </time>
                  <span aria-hidden="true">&middot;</span>
                  <span>{calculateReadingTime(post.content)} min read</span>
                </div>
              </div>
            </div>
          </div>
          
          <div 
            className="mt-12 prose prose-indigo prose-lg mx-auto"
            dangerouslySetInnerHTML={{ __html: post.content }}
          />
          
          <div className="mt-16 border-t border-gray-200 pt-8">
            <div className="flex items-center justify-between">
              <div className="flex items-center space-x-2">
                <span className="text-sm text-gray-500">Share this post:</span>
                <a href={`https://twitter.com/intent/tweet?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(post.title)}`} target="_blank" rel="noopener noreferrer" className="text-gray-400 hover:text-gray-500">
                  <span className="sr-only">Twitter</span>
                  <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                  </svg>
                </a>
                <a href={`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`} target="_blank" rel="noopener noreferrer" className="text-gray-400 hover:text-gray-500">
                  <span className="sr-only">Facebook</span>
                  <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fillRule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clipRule="evenodd" />
                  </svg>
                </a>
                <a href={`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.href)}`} target="_blank" rel="noopener noreferrer" className="text-gray-400 hover:text-gray-500">
                  <span className="sr-only">LinkedIn</span>
                  <svg className="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fillRule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clipRule="evenodd" />
                  </svg>
                </a>
              </div>
              
              {user && user.is_admin && (
                <Link to={`/admin/posts/${post.id}/edit`} className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                  Edit Post
                </Link>
              )}
            </div>
          </div>
        </div>
      </article>
      
      {relatedPosts.length > 0 && (
        <div className="bg-gray-50 py-16">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="max-w-3xl mx-auto">
              <h2 className="text-2xl font-extrabold text-gray-900 mb-8">More Articles</h2>
              <div className="grid gap-8 md:grid-cols-2">
                {relatedPosts.map(relatedPost => (
                  <div key={relatedPost.id} className="flex flex-col rounded-lg shadow-sm overflow-hidden">
                    <div className="flex-1 bg-white p-6 flex flex-col justify-between">
                      <div className="flex-1">
                        <Link to={`/blog/${relatedPost.slug}`} className="block">
                          <h3 className="text-lg font-semibold text-gray-900 hover:text-indigo-600">{relatedPost.title}</h3>
                          <p className="mt-3 text-sm text-gray-500">
                            {relatedPost.content.length > 100 
                              ? relatedPost.content.substring(0, 100).replace(/<[^>]*>/g, '') + '...' 
                              : relatedPost.content.replace(/<[^>]*>/g, '')}
                          </p>
                        </Link>
                      </div>
                      <div className="mt-4">
                        <Link to={`/blog/${relatedPost.slug}`} className="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                          Read more <span aria-hidden="true">&rarr;</span>
                        </Link>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      )}
    </>
  );
}

export default PostDetail; 