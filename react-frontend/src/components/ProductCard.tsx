import React from "react";
import { Link } from "react-router-dom";
import { Product } from "../types/ProductType";

type ProductProp = {
  product: Product
}

export const ProductCard = ({product}: ProductProp ) => {

  return (
    <div className="group relative">
      <div className="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
        <Link to={`/product/${product.slug}`}>
          <img
            src={product.main_image_url}
            alt="Front of men&#039;s Basic Tee in black."
            className="h-full w-full object-cover object-center lg:h-full lg:w-full"
          />
        </Link>
      </div>
      <div className="mt-4 flex justify-between">
        <div>
          <h3 className="text-sm text-gray-700">
              <Link to={`/product/${product.slug}`}>
                <span aria-hidden="true" className="absolute inset-0"></span>
                {product.name}
              </Link>
          </h3>
        </div>
        <p className="text-sm font-medium text-gray-900">${product.price}</p>
      </div>
    </div>
  );
};
