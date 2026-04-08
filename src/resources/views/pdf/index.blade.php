<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{$recipe->name}}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="">
        <div>
            <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">{{$recipe->name}}</h2>
        </div>
        <div class="">
            <p>{{$recipe->description}}</p>
        </div>
        <p class="mt-2">Oprindelsesland: {{$recipe->country}}</p>
        <div class="my-3">
            <p>Til {{$recipe->base_amount}} personer</p>
        </div>
        <div class="flex flex-row">
            <img src="clock.svg" class="mr-2" alt=""/>
            <p>Arbejdestid {{$recipe->cook_time}} min.</p>
        </div>
        <div class="my-3">
            <p class="mb-1">Kategorier:</p>
            <div class="flex flex-row gap-2">
                <?php
                    if (!empty($recipe->categories)) {
                        foreach ($recipe->categories as $item ) {?>
                            <div class="border border-gray-400 py-1 px-2 text-sm text-gray-300 rounded">

                                <div>
                                    {{$item->name}}
                                </div>
                            </div>
                    <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="mb-3">
            <p class="mb-1">Ret:</p>
            <div class="flex flex-row gap-2">
                <?php
                    if (!empty($recipe->courses)) {
                        foreach ($recipe->courses as $item ) {?>
                        <div class="border border-gray-400 py-1 px-2 text-sm text-gray-300 rounded">
                            <div>
                                {{$item->name}}
                            </div>
                        </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="flex flex-row justify-between mt-6">
            <div>
                <p>Ingredienser:</p>
                <?php
                    if (!empty($recipe->ingredients)) {
                        foreach ($recipe->ingredients as $item ) {?>
                            <div>
                                {{$item->pivot->measurements}} {{$item->pivot->unit}} {{$item->name}}
                            </div>
                <?php
                        }
                    } else {?>
                        <div>Ingen ingredienser tilføjet</div>
                <?php } ?>
            </div>
            <div class="border border-red-500 w-1/2">
                <img src="{{$recipe->image_name}}" alt="" class="w-full" ></img>
            </div>
        </div>
        <div v-if="recipe.guide" class="mt-6">
            <p>Fremgangsmåde:</p>
            <div class="whitespace-pre-wrap">{{$recipe->guide}}</div>
        </div>
        <div class="grid gap-2 mt-6">
            <Label for="notes">Egne noter</Label>
            <div class="p-2 w-2/3 border border-emerald-600 dark:border-emerald-800 rounded">
                <p class="wrap-break-word">{{ $recipe->pivot->notes }}</p>
            </div>
        </div>
    </div>
</body>
</html>
