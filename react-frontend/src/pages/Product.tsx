import React from 'react'
import { useQuery } from 'urql';

const AllCategories = `
query GetAllCategories {
  allCategory  {
      id
      name
      slug
  }
}
`;
interface Category {
  id: string,
  name: string,
  slug: string
}

export const Product = () => {
  const [result, reexecuteQuery] = useQuery({
    query: AllCategories,
  });

  const { data, fetching, error } = result;

  if (fetching) return <p>Loading...</p>;
  if (error) return <p>Oh no... {error.message}</p>;

  return (
    <ul className='mt-5'>
      {data.allCategory.map((todo: Category) => (
        <li className='text-red-500' key={todo.id}>{todo.name}</li>
      ))}
    </ul>
  );
};

