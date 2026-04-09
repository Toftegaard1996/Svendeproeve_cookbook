import Recipes from "@/routes/recipe";

export type User = {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};

export type TwoFactorConfigContent = {
    title: string;
    description: string;
    buttonText: string;
};

export type Recipe = {
    id: number;
    name: string;
    description: string;
    cook_time: number;
    base_amount: number;
    guide: string;
    country: string;
    image_name: string;
    category_recipe?: Category_Recipe;
    course_recipe?: Course_Recipe;
    ingredient_recipe?: Ingredient_Recipe;
    recipe_user?: Recipe_User;
    courses?: Course;
    categories?: Category;
    ingredients?: Ingredient;
}

export type Recipe_User = {
    id: number;
    recipe_id: Recipe;
    user_id: User
    notes: string;
}

export type Category = {
    id: number;
    name: string;
};

export type Category_Recipe = {
    id: number;
    category_id: Category;
    recipe_id: Recipe;
    created_at: string;
    updated_at: string;
}

export type Course = {
    id: number;
    name: string;
};

export type Course_Recipe = {
    id: number;
    course_id: Course;
    recipe_id: Recipe;
    created_at: string;
    updated_at: string;
}

export type Ingredient = {
    id: number;
    name: string;
};

export type Ingredient_Recipe = {
    id: number;
    ingredient_id: Ingredient;
    recipe_id: Recipe;
    measurements: number;
    unit: string;
    created_at: string;
    updated_at: string;
}
