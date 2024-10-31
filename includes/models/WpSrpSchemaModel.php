<?php

if (!class_exists('WP_SRP_Schema_Model')):
    class WP_SRP_Schema_Model {

        function __construct()
        {

        }

        function schemaOutput($schemaID, $metaData)
        {
            $html = null;

            if ($schemaID) {
                global $WpSrpSchema;
                switch ($schemaID) {
                  /*  case "article":
                        $article = array();
                        $article["@context"] = "http://schema.org";
                        $article["@type"] = "Article";
                        if (!empty($metaData['headline'])) {
                            $article["headline"] = $WpSrpSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $article["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $WpSrpSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $article["author"] = array(
                                "@type" => "Person",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $WpSrpSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $article["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['alternativeHeadline'])) {
                            $article["alternativeHeadline"] = $WpSrpSchema->sanitizeOutPut($metaData['alternativeHeadline']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                            $article["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $article["datePublished"] = $WpSrpSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $article["dateModified"] = $WpSrpSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['description'])) {
                            $article["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $article["articleBody"] = $WpSrpSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode($article);
                        break;

                    case "news_article":
                        $newsArticle = array();
                        $newsArticle["@context"] = "http://schema.org";
                        $newsArticle["@type"] = "NewsArticle";
                        if (!empty($metaData['headline'])) {
                            $newsArticle["headline"] = $WpSrpSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $newsArticle["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $WpSrpSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $newsArticle["author"] = array(
                                "@type" => "Person",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                            $newsArticle["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $newsArticle["datePublished"] = $WpSrpSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $newsArticle["dateModified"] = $WpSrpSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $WpSrpSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $newsArticle["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['description'])) {
                            $newsArticle["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $newsArticle["articleBody"] = $WpSrpSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode($newsArticle);
                        break;

                    case "blog_posting":
                        $blogPosting = array();
                        $blogPosting["@context"] = "http://schema.org";
                        $blogPosting["@type"] = "BlogPosting";
                        if (!empty($metaData['headline'])) {
                            $blogPosting["headline"] = $WpSrpSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $blogPosting["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $WpSrpSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $blogPosting["author"] = array(
                                "@type" => "Person",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                            $blogPosting["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $blogPosting["datePublished"] = $WpSrpSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $blogPosting["dateModified"] = $WpSrpSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $WpSrpSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $blogPosting["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['description'])) {
                            $blogPosting["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $blogPosting["articleBody"] = $WpSrpSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode($blogPosting);
                        break;

                    case 'event':
                        $event = array();
                        $event["@context"] = "http://schema.org";
                        $event["@type"] = "Event";
                        if (!empty($metaData['name'])) {
                            $event["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['startDate'])) {
                            $event["startDate"] = $WpSrpSchema->sanitizeOutPut($metaData['startDate']);
                        }
                        if (!empty($metaData['endDate'])) {
                            $event["endDate"] = $WpSrpSchema->sanitizeOutPut($metaData['endDate']);
                        }
                        if (!empty($metaData['description'])) {
                            $event["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['performerName'])) {
                            $event["performer"] = array(
                                "@type" => "Person",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['performerName'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $event["image"] = $WpSrpSchema->sanitizeOutPut($metaData['image'], 'url');
                        }
                        if (!empty($metaData['locationName'])) {
                            $event["location"] = array(
                                "@type"   => "Place",
                                "name"    => $WpSrpSchema->sanitizeOutPut($metaData['locationName']),
                                "address" => $WpSrpSchema->sanitizeOutPut($metaData['locationAddress'])
                            );
                        }
                        if (!empty($metaData['price'])) {
                            $event["offers"] = array(
                                "@type"         => "Offer",
                                "price"         => $WpSrpSchema->sanitizeOutPut($metaData['price']),
                                "priceCurrency" => !empty($metaData['priceCurrency']) ? $WpSrpSchema->sanitizeOutPut($metaData['priceCurrency']) : null,
                                "url"           => !empty($metaData['url']) ? $WpSrpSchema->sanitizeOutPut($metaData['url'],
                                    'url') : null
                            );
                        }
                        if (!empty($metaData['url'])) {
                            $event["url"] = $WpSrpSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode($event);
                        break;

                    case 'product':
                        $product = array();
                        $product["@context"] = "http://schema.org";
                        $product["@type"] = "Product";
                        if (!empty($metaData['name'])) {
                            $product["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                            $product["image"] = $WpSrpSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['description'])) {
                            $product["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['brand'])) {
                            $product["brand"] = array(
                                "@type" => "Thing",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['brand'])
                            );
                        }
                        if (!empty($metaData['ratingValue'])) {
                            $product["aggregateRating"] = array(
                                "@type"       => "AggregateRating",
                                "ratingValue" => !empty($metaData['ratingValue']) ? $WpSrpSchema->sanitizeOutPut($metaData['ratingValue']) : null,
                                "reviewCount" => !empty($metaData['reviewCount']) ? $WpSrpSchema->sanitizeOutPut($metaData['reviewCount']) : null
                            );
                        }
                        if (!empty($metaData['price'])) {
                            $product["offers"] = array(
                                "@type"         => "Offer",
                                "price"         => $WpSrpSchema->sanitizeOutPut($metaData['price']),
                                "priceCurrency" => !empty($metaData['priceCurrency']) ? $WpSrpSchema->sanitizeOutPut($metaData['priceCurrency']) : null,
                                "itemCondition" => !empty($metaData['itemCondition']) ? $WpSrpSchema->sanitizeOutPut($metaData['itemCondition']) : null,
                                "availability"  => !empty($metaData['availability']) ? $WpSrpSchema->sanitizeOutPut($metaData['availability']) : null,
                                "url"           => !empty($metaData['url']) ? $WpSrpSchema->sanitizeOutPut($metaData['url']) : null
                            );
                        }
                        $html .= $this->get_jsonEncode($product);
                        break;

                    case 'video':
                        $video = array();
                        $video["@context"] = "http://schema.org";
                        $video["@type"] = "VideoObject";
                        if (!empty($metaData['name'])) {
                            $video["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $video["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['description'])) {
                            $video["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['thumbnailUrl'])) {
                            $video["thumbnailUrl"] = $WpSrpSchema->sanitizeOutPut($metaData['thumbnailUrl'], 'url');
                        }
                        if (!empty($metaData['uploadDate'])) {
                            $video["uploadDate"] = $WpSrpSchema->sanitizeOutPut($metaData['uploadDate']);
                        }
                        if (!empty($metaData['duration'])) {
                            $video["duration"] = $WpSrpSchema->sanitizeOutPut($metaData['duration']);
                        }
                        if (!empty($metaData['contentUrl'])) {
                            $video["contentUrl"] = $WpSrpSchema->sanitizeOutPut($metaData['contentUrl'], 'url');
                        }
                        if (!empty($metaData['interactionCount'])) {
                            $video["interactionCount"] = $WpSrpSchema->sanitizeOutPut($metaData['interactionCount']);
                        }
                        if (!empty($metaData['expires'])) {
                            $video["expires"] = $WpSrpSchema->sanitizeOutPut($metaData['expires']);
                        }
                        $html .= $this->get_jsonEncode($video);
                        break;

                    case 'service':
                        $service = array();
                        $service["@context"] = "http://schema.org";
                        $service["@type"] = "Service";
                        if (!empty($metaData['name'])) {
                            $service["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['serviceType'])) {
                            $service["serviceType"] = $WpSrpSchema->sanitizeOutPut($metaData['serviceType']);
                        }   */
                        /*
						if ( ! empty( $metaData['locationName'] ) ) {
							$service["location"] = array(
								"@type"   => "Place",
								"name"    => $WpSrpSchema->sanitizeOutPut( $metaData['locationName'] ),
								"address" => $WpSrpSchema->sanitizeOutPut( $metaData['locationAddress'] )
							);
						}*/
     /*                   if (!empty($metaData['award'])) {
                            $service["award"] = $WpSrpSchema->sanitizeOutPut($metaData['award']);
                        }
                        if (!empty($metaData['category'])) {
                            $service["category"] = $WpSrpSchema->sanitizeOutPut($metaData['category']);
                        }
                        if (!empty($metaData['providerMobility'])) {
                            $service["providerMobility"] = $WpSrpSchema->sanitizeOutPut($metaData['providerMobility']);
                        }
                        if (!empty($metaData['additionalType'])) {
                            $service["additionalType"] = $WpSrpSchema->sanitizeOutPut($metaData['additionalType']);
                        }
                        if (!empty($metaData['alternateName'])) {
                            $service["alternateName"] = $WpSrpSchema->sanitizeOutPut($metaData['alternateName']);
                        }
                        if (!empty($metaData['image'])) {
                            $service["image"] = $WpSrpSchema->sanitizeOutPut($metaData['image']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $service["mainEntityOfPage"] = $WpSrpSchema->sanitizeOutPut($metaData['mainEntityOfPage']);
                        }
                        if (!empty($metaData['sameAs'])) {
                            $service["sameAs"] = $WpSrpSchema->sanitizeOutPut($metaData['sameAs']);
                        }
                        if (!empty($metaData['url'])) {
                            $service["url"] = $WpSrpSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode($service);
                        break;

                    case 'review':
                        $review = array();
                        $review["@context"] = "http://schema.org";
                        $review["@type"] = "Review";
                        if (!empty($metaData['itemName'])) {
                            $review["itemReviewed"] = array(
                                "@type" => "Thing",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['itemName'])
                            );
                        }
                        if (!empty($metaData['ratingValue'])) {
                            $review["reviewRating"] = array(
                                "@type"       => "Rating",
                                "ratingValue" => $WpSrpSchema->sanitizeOutPut($metaData['ratingValue']),
                                "bestRating"  => $WpSrpSchema->sanitizeOutPut($metaData['bestRating']),
                                "worstRating" => $WpSrpSchema->sanitizeOutPut($metaData['worstRating'])
                            );
                        }
                        if (!empty($metaData['name'])) {
                            $review["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['author'])) {
                            $review["author"] = array(
                                "@type" => "Person",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['reviewBody'])) {
                            $review["reviewBody"] = $WpSrpSchema->sanitizeOutPut($metaData['reviewBody']);
                        }
                        if (!empty($metaData['datePublished'])) {
                            $review["datePublished"] = $WpSrpSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['publisher'])) {
                            $review["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $WpSrpSchema->sanitizeOutPut($metaData['publisher'])
                            );
                        }
                        $html .= $this->get_jsonEncode($review);
                        break;   */
                    case 'aggregate_rating':
                        $aRating = array();
                        $aRating["@context"] = "http://schema.org";
                        $aRating["@type"] = !empty($metaData['schema_type']) ? $metaData['schema_type'] : "LocalBusiness";
                        if (!empty($metaData['name'])) {
                            $aRating["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $aRating["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if ($aRating["@type"] != "Organization") {
                            if (!empty($metaData['image'])) {
                                $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                                $aRating["image"] = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $WpSrpSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            }
                            if (!empty($metaData['priceRange'])) {
                                $aRating["priceRange"] = $WpSrpSchema->sanitizeOutPut($metaData['priceRange']);
                            }
                            if (!empty($metaData['telephone'])) {
                                $aRating["telephone"] = $WpSrpSchema->sanitizeOutPut($metaData['telephone']);
                            }

                            if (!empty($metaData['address'])) {
                                $aRating["address"] = $WpSrpSchema->sanitizeOutPut($metaData['address']);
                            }
                        }

                        if (!empty($metaData['ratingValue'])) {
                            $rValue = array();
                            $rValue["@type"] = "AggregateRating";
                            $rValue["ratingValue"] = $WpSrpSchema->sanitizeOutPut($metaData['ratingValue']);
                            if (!empty($metaData['bestRating'])) {
                                $rValue["bestRating"] = $WpSrpSchema->sanitizeOutPut($metaData['bestRating']);
                            }
                            if (!empty($metaData['worstRating'])) {
                                $rValue["worstRating"] = $WpSrpSchema->sanitizeOutPut($metaData['worstRating']);
                            }
                            if (!empty($metaData['ratingCount'])) {
                                $rValue["ratingCount"] = $WpSrpSchema->sanitizeOutPut($metaData['ratingCount']);
                            }

                            $aRating["aggregateRating"] = $rValue;
                        }
                        $html .= $this->get_jsonEncode($aRating);
                        break;
/*
                   case 'restaurant':
                        $restaurant = array();
                        $restaurant["@context"] = "http://schema.org";
                        $restaurant["@type"] = "Restaurant";
                        if (!empty($metaData['name'])) {
                            $restaurant["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $restaurant["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['openingHours'])) {
                            $restaurant["openingHours"] = $WpSrpSchema->sanitizeOutPut($metaData['openingHours'],
                                'textarea');
                        }
                        if (!empty($metaData['telephone'])) {
                            $restaurant["telephone"] = $WpSrpSchema->sanitizeOutPut($metaData['telephone']);
                        }
                        if (!empty($metaData['menu'])) {
                            $restaurant["menu"] = $WpSrpSchema->sanitizeOutPut($metaData['menu'], 'url');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                            $restaurant["image"] = $WpSrpSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['address'])) {
                            $restaurant["address"] = $WpSrpSchema->sanitizeOutPut($metaData['address'], 'textarea');
                        }
                        if (!empty($metaData['priceRange'])) {
                            $restaurant["priceRange"] = $WpSrpSchema->sanitizeOutPut($metaData['priceRange']);
                        }
                        if (!empty($metaData['servesCuisine'])) {
                            $restaurant["servesCuisine"] = $WpSrpSchema->sanitizeOutPut($metaData['servesCuisine']);
                        }
                        $html .= $this->get_jsonEncode($restaurant);
                        break;
                         
                    case 'localBusiness':
                        $localBusiness = array();
                        $localBusiness["@context"] = "http://schema.org";
                        $localBusiness["@type"] = "LocalBusiness";
                        if (!empty($metaData['name'])) {
                            $localBusiness["name"] = $WpSrpSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $localBusiness["description"] = $WpSrpSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $WpSrpSchema->imageInfo(absint($metaData['image']));
                            $localBusiness["image"] = $WpSrpSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['priceRange'])) {
                            $localBusiness["priceRange"] = $WpSrpSchema->sanitizeOutPut($metaData['priceRange']);
                        }
                        if (!empty($metaData['addressLocality']) || !empty($metaData['addressRegion'])
                            || !empty($metaData['postalCode']) || !empty($metaData['streetAddress'])) {
                            $localBusiness["address"] = array(
                                "@type"           => "PostalAddress",
                                "addressLocality" => $WpSrpSchema->sanitizeOutPut($metaData['addressLocality']),
                                "addressRegion"   => $WpSrpSchema->sanitizeOutPut($metaData['addressRegion']),
                                "postalCode"      => $WpSrpSchema->sanitizeOutPut($metaData['postalCode']),
                                "streetAddress"   => $WpSrpSchema->sanitizeOutPut($metaData['streetAddress'])
                            );
                        }

                        if (!empty($metaData['telephone'])) {
                            $localBusiness["telephone"] = $WpSrpSchema->sanitizeOutPut($metaData['telephone']);
                        }
                        $html .= $this->get_jsonEncode($localBusiness);
                        break; 
                                   */
                    default:
                        break;
                }

            }

            return $html;
        }

        function get_field($data)
        {
            $html = null;
            global $WpSrpSchema;
            $id = $data['id'];
            $name = $data['name'];
            $value = $data['value'];
            $attr = !empty($data['attr']) ? $data['attr'] : null;

            $class = isset($data['class']) ? ($data['class'] ? $data['class'] : null) : null;
            $require = (isset($data['required']) ? ($data['required'] ? "<span class='required'>*</span>" : null) : null);
            $title = (isset($data['title']) ? ($data['title'] ? $data['title'] : null) : null);
            $desc = (isset($data['desc']) ? ($data['desc'] ? $data['desc'] : null) : null);
            $holderClass = (!empty($data['holderClass']) ? $data['holderClass'] : null);
            $html .= "<div class='field-container {$holderClass}' id='" . $id . '-container' . "'>";
            $html .= "<label class='field-label' for='{$id}'>{$title}{$require}</label>";
            $html .= "<div class='field-content' id='" . $id . '-content' . "'>";
            switch ($data['type']) {
                case 'checkbox':
                    $checked = ($value ? "checked" : null);
                    $html .= "<div class='WpSrp-checkbox-wrapper'>";
                    $html .= "<label for='{$id}'><input type='checkbox' id='{$id}' class='{$class}' name='{$name}' {$checked} value='1' /> Enable</label>";
                    $html .= "</div>";
                    break;

                case 'text':
                    $html .= "<input type='text' id='{$id}' class='{$class}' name='{$name}' value='" . esc_html($value) . "' />";
                    break;

                case 'number':
                    $html .= "<input type='number' {$attr} id='{$id}' class='{$class}' name='{$name}' value='" . esc_attr($value) . "' />";
                    break;
                case 'textarea':
                    $html .= "<textarea id='{$id}' class='{$class}' name='{$name}' >" . wp_kses($value,
                            array()) . "</textarea>";
                    break;

                case 'image':
                    $html .= '<div class="WpSrp-image">';
                    $ImageId = !empty($value) ? absint($value) : 0;
                    $image = $ingInfo = null;
                    if ($ImageId) {
                        $image = wp_get_attachment_image($ImageId, "thumbnail");
                        $imgData = $WpSrpSchema->imageInfo($ImageId);
                        $ingInfo .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
                        $ingInfo .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
                        $ingInfo .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
                    }
                    $html .= "<div class='WpSrp-image-wrapper'>";
                    $html .= '<span class="WpSrpImgAdd"><span class="dashicons dashicons-plus-alt"></span></span>';
                    $html .= '<span class="WpSrpImgRemove ' . ($image ? null : "WpSrp-hidden") . '"><span class="dashicons dashicons-trash"></span></span>';
                    $html .= '<div class="WpSrp-image-preview">' . $image . '</div>';
                    $html .= "<input type='hidden' name='{$name}' value='" . absint($ImageId) . "' />";
                    $html .= "</div>";
                    $html .= "<div class='image-info'>{$ingInfo}</div>";
                    $html .= '</div>';
                    break;
                case 'select':
                    $html .= "<select name='{$name}' class='select2 {$class}' id='{$id}'>";
                    if (!empty($data['empty'])) {
                        $html .= "<option value=''>{$data['empty']}</option>";
                    }
                    if (!empty($data['options']) && is_array($data['options'])) {
                        if ($this->isAssoc($data['options'])) {
                            foreach ($data['options'] as $optKey => $optValue) {
                                $slt = ($optKey == $value ? "selected" : null);
                                $html .= "<option value='" . esc_attr($optKey) . "' {$slt}>" . esc_html($optValue) . "</option>";
                            }
                        } else {
                            foreach ($data['options'] as $optValue) {
                                $slt = ($optValue == $value ? "selected" : null);
                                $html .= "<option value='" . esc_attr($optValue) . "' {$slt}>" . esc_html($optValue) . "</option>";
                            }
                        }
                    }
                    $html .= "</select>";
                    break;
                case 'schema_type':
                    $html .= "<select name='{$name}' class='select2 {$class}' id='{$id}'>";
                    if (!empty($data['empty'])) {
                        $html .= "<option value=''>{$data['empty']}</option>";
                    }

                    foreach ($data['options'] as $key => $site) {
                        if (is_array($site)) {
                            $slt = ($key == $value ? "selected" : null);
                            $html .= "<option value='$key' $slt>&nbsp;&nbsp;&nbsp;$key</option>";
                            foreach ($site as $inKey => $inSite) {
                                if (is_array($inSite)) {
                                    $slt = ($inKey == $value ? "selected" : null);
                                    $html .= "<option value='$inKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inKey</option>";
                                    foreach ($inSite as $inInKey => $inInSite) {
                                        if (is_array($inInSite)) {
                                            $slt = ($inInKey == $value ? "selected" : null);
                                            $html .= "<option value='$inInKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInKey</option>";
                                            foreach ($inInSite as $iSite) {
                                                $slt = ($iSite == $value ? "selected" : null);
                                                $html .= "<option value='$iSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iSite</option>";
                                            }
                                        } else {
                                            $slt = ($inInSite == $value ? "selected" : null);
                                            $html .= "<option value='$inInSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInSite</option>";
                                        }
                                    }
                                } else {
                                    $slt = ($inSite == $value ? "selected" : null);
                                    $html .= "<option value='$inSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inSite</option>";
                                }
                            }
                        } else {
                            $slt = ($site == $value ? "selected" : null);
                            $html .= "<option value='$site' $slt>$site</option>";
                        }
                    }
                    $html .= "</select>";
                    break;
                default:
                    $html .= "<input id='{$id}' type='{$data['type']}' value='" . esc_attr($value) . "' name='$name' />";
                    break;

            }
            $html .= "<p class='description'>{$desc}</p>";
            $html .= "</div>";
            $html .= "</div>";

            return $html;
        }

        public function schemaTypes()
        {
            return array(
             /*   'article'          => array(
                    'title'  => __("Article", "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'              => array(
                            'type' => 'checkbox'
                        ),
                        'headline'            => array(
                            'title'    => __('Headline', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Article title', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'mainEntityOfPage'    => array(
                            'title'    => __('Page URL', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'url',
                            'desc'     => __('The canonical URL of the article page', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'author'              => array(
                            'title'    => __('Author Name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Author display name', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'image'               => array(
                            'title'    => __('Article Feature Image', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'required' => true,
                            'desc'     => __('Images should be at least 696 pixels wide.<br>Images should be in .jpg, .png, or. gif format.', "wp-srp-schema-for-dynamic-url")
                        ),
                        'datePublished'       => array(
                            'title'    => __('Published date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'required' => true,
                            'desc'     => __('Like this: 2015-12-25', "wp-srp-schema-for-dynamic-url")
                        ),
                        'dateModified'        => array(
                            'title'    => __('Modified date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'required' => true,
                            'desc'     => __('Like this: 2015-12-25', "wp-srp-schema-for-dynamic-url")
                        ),
                        'publisher'           => array(
                            'title'    => __('Publisher', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Publisher name or Organization name', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'publisherImage'      => array(
                            'title'    => __('Publisher Logo', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'desc'     => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'description'         => array(
                            'title' => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Short description', "wp-srp-schema-for-dynamic-url")
                        ),
                        'articleBody'         => array(
                            'title' => __('Article body', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Article content', "wp-srp-schema-for-dynamic-url")
                        ),
                        'alternativeHeadline' => array(
                            'title' => __('Alternative headline', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('A secondary headline for the article.', "wp-srp-schema-for-dynamic-url")
                        ),
                    )
                ),
                'blog_posting'     => array(
                    'title'  => __('Blog Posting', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'headline'         => array(
                            'title'    => __('Headline', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Blog posting title', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'mainEntityOfPage' => array(
                            'title'    => __('Page URL', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'url',
                            'desc'     => __('The canonical URL of the article page', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'author'           => array(
                            'title'    => __('Author name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Author display name', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'image'            => array(
                            'title'    => __('Feature Image', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'desc'     => __("The representative image of the article. Only a marked-up image that directly belongs to the article should be specified.<br> Images should be at least 696 pixels wide. <br>Images should be in .jpg, .png, or. gif format.", "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'datePublished'    => array(
                            'title'    => __('Published date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'desc'     => __('Like this: 2015-12-25', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'dateModified'     => array(
                            'title'    => __('Modified date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'desc'     => __('Like this: 2015-12-25', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'publisher'        => array(
                            'title'    => __('Publisher', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Publisher name or Organization name', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'publisherImage'   => array(
                            'title'    => __('Publisher Logo', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'desc'     => __("Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>", "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'description'      => array(
                            'title' => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Short description', "wp-srp-schema-for-dynamic-url")
                        ),
                        'articleBody'      => array(
                            'title' => __('Article body', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Article content', "wp-srp-schema-for-dynamic-url")
                        )
                    )
                ),
                'news_article'     => array(
                    'title'  => __('News Article', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'headline'         => array(
                            'title'    => __('Headline', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Article title', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'mainEntityOfPage' => array(
                            'title'    => __('Page URL', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'url',
                            'desc'     => __('The canonical URL of the article page', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'author'           => array(
                            'title'    => __('Author', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Author display name', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'image'            => array(
                            'title'    => __('Image', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'desc'     => __("The representative image of the article. Only a marked-up image that directly belongs to the article should be specified.<br> Images should be at least 696 pixels wide. <br>Images should be in .jpg, .png, or. gif format.", "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'datePublished'    => array(
                            'title'    => __('Published date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'desc'     => __('Like this: 2015-12-25', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'dateModified'     => array(
                            'title'    => __('Modified date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'required' => true,
                            'desc'     => __('Like this: 2015-12-25', "wp-srp-schema-for-dynamic-url")
                        ),
                        'publisher'        => array(
                            'title'    => __('Publisher', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'desc'     => __('Publisher name or Organization name', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'publisherImage'   => array(
                            'title'    => __('Publisher Logo', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'desc'     => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-srp-schema-for-dynamic-url"),
                            'required' => true
                        ),
                        'description'      => array(
                            'title' => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Short description', "wp-srp-schema-for-dynamic-url")
                        ),
                        'articleBody'      => array(
                            'title' => __('Article body', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Article body content', "wp-srp-schema-for-dynamic-url")
                        )
                    )
                ),
                'event'            => array(
                    'title'  => __('Event', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'          => array(
                            'type' => 'checkbox'
                        ),
                        'name'            => array(
                            'title'    => __('Name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The name of the event.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'locationName'    => array(
                            'title'    => __('Location name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("Event Location name", "wp-srp-schema-for-dynamic-url")
                        ),
                        'locationAddress' => array(
                            'title'    => __('Location address', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The location of for example where the event is happening, an organization is located, or where an action takes place.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'startDate'       => array(
                            'title'    => __('Start date', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'class'    => 'wpsrp-date',
                            'required' => true,
                            'desc'     => __("Event start date", "wp-srp-schema-for-dynamic-url")
                        ),
                        'endDate'         => array(
                            'title' => __('End date (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'class' => 'wpsrp-date',
                            'desc'  => __("Event end date", "wp-srp-schema-for-dynamic-url")
                        ),
                        'description'     => array(
                            'title' => __('Description (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __("Event description", "wp-srp-schema-for-dynamic-url")
                        ),
                        'performerName'   => array(
                            'title' => __('Performer Name (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The performer's name.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'image'           => array(
                            'title' => __('Image URL (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'url',
                            'desc'  => __("URL of an image or logo for the event or tour", "wp-srp-schema-for-dynamic-url")
                        ),
                        'price'           => array(
                            'title' => __('Price (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("This is highly recommended. The lowest available price, including service charges and fees, of this type of ticket. <span class='required'>Not required but (Recommended)</span>", "wp-srp-schema-for-dynamic-url")
                        ),
                        'priceCurrency'   => array(
                            'title' => __('Price currency', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The 3-letter currency code. (USD)", "wp-srp-schema-for-dynamic-url")
                        ),
                        'url'             => array(
                            'title'       => 'URL (Recommended)',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("A link to the event's details page. <span class='required'>Not required but (Recommended)</span>", "wp-srp-schema-for-dynamic-url")
                        ),
                    )
                ),
                'product'          => array(
                    'title'  => __('Product', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'        => array(
                            'type' => 'checkbox'
                        ),
                        'name'          => array(
                            'title'    => __('Name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The name of the product.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'image'         => array(
                            'title' => __('Image', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'image',
                            'desc'  => __("The URL of a product photo. Pictures clearly showing the product, e.g. against a white background, are preferred.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'description'   => array(
                            'title' => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __("Product description.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'brand'         => array(
                            'title' => __('Brand', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The brand of the product.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'ratingValue'   => array(
                            'title' => __('Ratting value', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("Rating value. (1 , 2.5, 3, 5 etc)", "wp-srp-schema-for-dynamic-url")
                        ),
                        'reviewCount'   => array(
                            'title' => __('Total review count', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("Rating ratting value. <span class='required'>This is required if (Ratting value) is given</span>", "wp-srp-schema-for-dynamic-url")
                        ),
                        'price'         => array(
                            'title' => __('Price', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("The lowest available price, including service charges and fees, of this type of ticket.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'priceCurrency' => array(
                            'title' => __('Price currency', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The 3-letter currency code.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'availability'  => array(
                            'title'   => 'Availability',
                            'type'    => 'select',
                            'empty'   => "Select one",
                            'options' => array(
                                'http://schema.org/InStock'             => 'InStock',
                                'http://schema.org/InStoreOnly'         => 'InStoreOnly',
                                'http://schema.org/OutOfStock'          => 'OutOfStock',
                                'http://schema.org/SoldOut'             => 'SoldOut',
                                'http://schema.org/OnlineOnly'          => 'OnlineOnly',
                                'http://schema.org/LimitedAvailability' => 'LimitedAvailability',
                                'http://schema.org/Discontinued'        => 'Discontinued',
                                'http://schema.org/PreOrder'            => 'PreOrder',
                            ),
                            'desc'    => __("Select a availability type", "wp-srp-schema-for-dynamic-url")
                        ),
                        'itemCondition' => array(
                            'title'   => 'Product condition',
                            'type'    => 'select',
                            'empty'   => "Select one",
                            'options' => array(
                                'http://schema.org/NewCondition'         => 'NewCondition',
                                'http://schema.org/UsedCondition'        => 'UsedCondition',
                                'http://schema.org/DamagedCondition'     => 'DamagedCondition',
                                'http://schema.org/RefurbishedCondition' => 'RefurbishedCondition',
                            ),
                            'desc'    => __("Select a condition", "wp-srp-schema-for-dynamic-url")
                        ),
                        'url'           => array(
                            'title' => __('Product URL', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'url',
                            'desc'  => __("A URL to the product web page (that includes the Offer). (Don't use offerURL for markup that appears on the product page itself.)", "wp-srp-schema-for-dynamic-url")
                        ),
                    )
                ),
                'video'            => array(
                    'title'  => __('Video', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'name'             => array(
                            'title'    => __('Name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The title of the video", "wp-srp-schema-for-dynamic-url")
                        ),
                        'description'      => array(
                            'title'    => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'textarea',
                            'required' => true,
                            'desc'     => __("The description of the video", "wp-srp-schema-for-dynamic-url")
                        ),
                        'thumbnailUrl'     => array(
                            'title'       => 'Thumbnail URL',
                            'type'        => 'url',
                            'placeholder' => "URL",
                            'required'    => true,
                            'desc'        => __("A URL pointing to the video thumbnail image file. Images must be at least 160x90 pixels and at most 1920x1080 pixels.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'uploadDate'       => array(
                            'title' => __('Updated date', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'class' => 'wpsrp-date',
                            'desc'  => __('2015-02-05T08:00:00+08:00', "wp-srp-schema-for-dynamic-url")
                        ),
                        'duration'         => array(
                            'title' => __('Duration', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The duration of the video in ISO 8601 format.(PT1M33S)", "wp-srp-schema-for-dynamic-url")
                        ),
                        'contentUrl'       => array(
                            'title'       => 'Content URL',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("A URL pointing to the actual video media file. This file should be in .mpg, .mpeg, .mp4, .m4v, .mov, .wmv, .asf, .avi, .ra, .ram, .rm, .flv, or other video file format.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'embedUrl'         => array(
                            'title'       => 'Embed URL',
                            'placeholder' => 'URL',
                            'type'        => 'url',
                            'desc'        => __("A URL pointing to a player for the specific video. Usually this is the information in the src element of an < embed> tag.Example: Dailymotion: http://www.dailymotion.com/swf/x1o2g.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'interactionCount' => array(
                            'title' => __('Interaction count', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The number of times the video has been viewed.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'expires'          => array(
                            'title' => __('Expires', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'class' => 'wpsrp-date',
                            'desc'  => __("Like this: 2015-12-25", "wp-srp-schema-for-dynamic-url")
                        ),
                    )
                ),
                'service'          => array(
                    'title'  => __('Service', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'name'             => array(
                            'title'    => __('Name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The name of the Service.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'serviceType'      => array(
                            'title'    => __('Service type', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The type of service being offered, e.g. veterans' benefits, emergency relief, etc.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'additionalType'   => array(
                            'title'       => 'Additional type(URL)',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("An additional type for the service, typically used for adding more specific types from external vocabularies in microdata syntax.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'award'            => array(
                            'title' => __('Award', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("An award won by or for this service.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'category'         => array(
                            'title' => __('Category', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("A category for the service.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'providerMobility' => array(
                            'title' => __('Provider mobility', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("Indicates the mobility of a provided service (e.g. 'static', 'dynamic').", "wp-srp-schema-for-dynamic-url")
                        ),
                        'description'      => array(
                            'title'   => 'Description',
                            'type'    => 'textarea',
                            'require' => true,
                            'desc'    => __("A short description of the service.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'image'            => array(
                            'title'   => 'Image URL',
                            'type'    => 'url',
                            'require' => false,
                            'desc'    => __("An image of the service. This should be a URL.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'mainEntityOfPage' => array(
                            'title'   => 'Main entity of page URL',
                            'type'    => 'url',
                            'require' => false,
                            'desc'    => __("Indicates a page (or other CreativeWork) for which this thing is the main entity being described.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'sameAs'           => array(
                            'title'       => 'Same as URL',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("URL of a reference Web page that unambiguously indicates the service's identity. E.g. the URL of the service's Wikipedia page, Freebase page, or official website.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'url'              => array(
                            'title'       => 'Url of the service',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("URL of the service.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'alternateName'    => array(
                            'title' => __('Alternate name', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('An alias for the service.', "wp-srp-schema-for-dynamic-url")
                        ),
                    )
                ),
                'review'           => array(
                    'title'  => __('Review', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'        => array(
                            'type' => 'checkbox'
                        ),
                        'itemName'      => array(
                            'title'    => __('Name of the reviewed item', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The item that is being reviewed.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'reviewBody'    => array(
                            'title'    => __('Review body', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'textarea',
                            'required' => true,
                            'desc'     => __("The actual body of the review.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'name'          => array(
                            'title'    => __('Review name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("A particular name for the review.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'author'        => array(
                            'title'    => __('Author', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'author'   => 'Author name',
                            'desc'     => __("The author of the review. The reviewer’s name needs to be a valid name.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'datePublished' => array(
                            'title' => __('Date of Published', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'class' => 'wpsrp-date',
                            'desc'  => __("Like this: 2015-12-25", "wp-srp-schema-for-dynamic-url")
                        ),
                        'ratingValue'   => array(
                            'title' => __('Rating value', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("A numerical quality rating for the item.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'bestRating'    => array(
                            'title' => __('Best rating', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("The highest value allowed in this rating system.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'worstRating'   => array(
                            'title' => __('Worst rating', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'publisher'     => array(
                            'title' => __('Name of the organization', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('The publisher of the review.', "wp-srp-schema-for-dynamic-url")
                        )
                    )
                ),  */
                'aggregate_rating' => array(
                    'title'  => __('Aggregate Ratings', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'      => array(
                            'type' => 'checkbox'
                        ),
                        'schema_type' => array(
                            'title'    => __('Schema type', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'schema_type',
                            'required' => true,
                            'options'  => $this->site_type(),
                            'empty'    => "Select one",
                            'desc'     => __("Use the most appropriate schema type for what is being reviewed.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'name'        => array(
                            'title'    => __('Name of the item', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The item that is being rated.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'image'       => array(
                            'title'       => 'Image',
                            'type'        => 'image',
                            'required'    => true,
                            'holderClass' => 'WpSrp-hidden aggregate-except-organization-holder'
                        ),
                        'priceRange'  => array(
                            'title'       => 'Price Range (Recommended)',
                            'type'        => 'text',
                            'holderClass' => 'WpSrp-hidden aggregate-except-organization-holder',
                            'desc'        => __("The price range of the business, for example $$$.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'telephone'   => array(
                            'title'       => 'Telephone (Recommended)',
                            'type'        => 'text',
                            'holderClass' => 'WpSrp-hidden aggregate-except-organization-holder'
                        ),
                        'address'     => array(
                            'title'       => 'Address (Recommended)',
                            'type'        => 'text',
                            'holderClass' => 'WpSrp-hidden aggregate-except-organization-holder',
                        ),
                        'description' => array(
                            'title' => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __("Description for thr review", "wp-srp-schema-for-dynamic-url")
                        ),
                        'ratingCount' => array(
                            'title'    => __('Rating Count', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("The total number of ratings for the item on your site. <span class='required'>* At least one of ratingCount or reviewCount is required.</span>", "wp-srp-schema-for-dynamic-url")
                        ),
                        'reviewCount' => array(
                            'title'    => __('Review Count', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("Specifies the number of people who provided a review with or without an accompanying rating. At least one of ratingCount or reviewCount is required.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'ratingValue' => array(
                            'title'    => __('Rating Value', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("A numerical quality rating for the item.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'ratingValue' => array(
                            'title'    => __('Rating Value', "wp-srp-schema-for-dynamic-url"),
                            'attr'     => 'step="any"',
                            'type'     => 'number',
                            'required' => true,
                            'desc'     => __("A numerical quality rating for the item.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'bestRating'  => array(
                            'title'    => __('Best Rating', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("The highest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If bestRating is omitted, 5 is assumed.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'worstRating' => array(
                            'title'    => __('Worst Rating', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("The lowest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If worstRating is omitted, 1 is assumed.", "wp-srp-schema-for-dynamic-url")
                        )
                    )
                )
             /*   'restaurant'       => array(
                    'title'  => __('Restaurant', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'        => array(
                            'type' => 'checkbox'
                        ),
                        'name'          => array(
                            'title'    => __('Name of the Restaurant', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true
                        ),
                        'description'   => array(
                            'title' => __('Description of the Restaurant', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                        ),
                        'openingHours'  => array(
                            'title' => __('Opening Hours', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                            'desc'  => __('Mo,Tu,We,Th,Fr,Sa,Su 11:30-23:00', "wp-srp-schema-for-dynamic-url")
                        ),
                        'telephone'     => array(
                            'title' => __('Opening Hours', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('+155501003333', "wp-srp-schema-for-dynamic-url")
                        ),
                        'menu'          => array(
                            'title' => __('Menu', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('http://example.com/menu', "wp-srp-schema-for-dynamic-url")
                        ),
                        'image'         => array(
                            'title'    => __('Image', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'required' => true
                        ),
                        'address'       => array(
                            'title' => __('Address', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea'
                        ),
                        'priceRange'    => array(
                            'title' => __('Price Range', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('The price range of the business, for example $$$', "wp-srp-schema-for-dynamic-url")
                        ),
                        'servesCuisine' => array(
                            'title' => __('Serves Cuisine', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('The cuisine of the restaurant.', "wp-srp-schema-for-dynamic-url")
                        )
                    )
                ), 
                'localBusiness'    => array(
                    'title'  => __('Local Business', "wp-srp-schema-for-dynamic-url"),
                    'fields' => array(
                        'active'          => array(
                            'type' => 'checkbox'
                        ),
                        'name'            => array(
                            'title'    => __('Name', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'text',
                            'required' => true
                        ),
                        'description'     => array(
                            'title' => __('Description', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'textarea',
                        ),
                        'image'           => array(
                            'title'    => __('Business Logo', "wp-srp-schema-for-dynamic-url"),
                            'type'     => 'image',
                            'required' => true
                        ),
                        'priceRange'      => array(
                            'title' => __('Price Range (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __("The price range of the business, for example $$$.", "wp-srp-schema-for-dynamic-url")
                        ),
                        'addressLocality' => array(
                            'title' => __('Address locality', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('City (i.e Kansas city)', "wp-srp-schema-for-dynamic-url")
                        ),
                        'addressRegion'   => array(
                            'title' => __('Address region', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                            'desc'  => __('State (i.e. MO)', "wp-srp-schema-for-dynamic-url")
                        ),
                        'postalCode'      => array(
                            'title' => __('Postal code', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                        ),
                        'streetAddress'   => array(
                            'title' => __('Street address', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                        ),
                        'telephone'       => array(
                            'title' => __('Telephone (Recommended)', "wp-srp-schema-for-dynamic-url"),
                            'type'  => 'text',
                        )
                    )
                )   */
            );
        }

        function get_jsonEncode($data = array())
        {
            $html = null;
            /** @var TYPE_NAME $data */
            if (!empty($data) && is_array($data)) {
                $html .= '<script type="application/ld+json">' . json_encode($data,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
            }

            return $html;
        }

        function site_type()
        {
            return array(
                'Organization',
                'LocalBusiness' => array(
                    'AnimalShelter',
                    'AutomotiveBusiness'          => array(
                        'AutoBodyShop',
                        'AutoDealer',
                        'AutoPartsStore',
                        'AutoRental',
                        'AutoRepair',
                        'AutoWash',
                        'GasStation',
                        'MotorcycleDealer',
                        'MotorcycleRepair'
                    ),
                    'ChildCare',
                    'DryCleaningOrLaundry',
                    'EmergencyService',
                    'EmploymentAgency',
                    'EntertainmentBusiness'       => array(
                        'AdultEntertainment',
                        'AmusementPark',
                        'ArtGallery',
                        'Casino',
                        'ComedyClub',
                        'MovieTheater',
                        'NightClub',

                    ),
                    'FinancialService'            => array(
                        'AccountingService',
                        'AutomatedTeller',
                        'BankOrCreditUnion',
                        'InsuranceAgency',
                    ),
                    'FoodEstablishment'           => array(
                        'Bakery',
                        'BarOrPub',
                        'Brewery',
                        'CafeOrCoffeeShop',
                        'FastFoodRestaurant',
                        'IceCreamShop',
                        'Restaurant',
                        'Winery',
                    ),
                    'GovernmentOffice',
                    'HealthAndBeautyBusiness'     => array(
                        'BeautySalon',
                        'DaySpa',
                        'HairSalon',
                        'HealthClub',
                        'NailSalon',
                        'TattooParlor',
                    ),
                    'HomeAndConstructionBusiness' => array(
                        'Electrician',
                        'GeneralContractor',
                        'HVACBusiness',
                        'HousePainter',
                        'Locksmith',
                        'MovingCompany',
                        'Plumber',
                        'RoofingContractor',
                    ),
                    'InternetCafe',
                    'LegalService'                => array(
                        'Attorney',
                        'Notary',
                    ),
                    'Library',
                    'MedicalBusiness'             => array(
                        'CommunityHealth',
                        'Dentist',
                        'Dermatology',
                        'DietNutrition',
                        'Emergency',
                        'Geriatric',
                        'Gynecologic',
                        'MedicalClinic',
                        'Midwifery',
                        'Nursing',
                        'Obstetric',
                        'Oncologic',
                        'Optician',
                        'Optometric',
                        'Otolaryngologic',
                        'Pediatric',
                        'Pharmacy',
                        'Physician',
                        'Physiotherapy',
                        'PlasticSurgery',
                        'Podiatric',
                        'PrimaryCare',
                        'Psychiatric',
                        'PublicHealth',
                    ),
                    'LodgingBusiness'             => array(
                        'BedAndBreakfast',
                        'Campground',
                        'Hostel',
                        'Hotel',
                        'Motel',
                        'Resort',
                    ),
                    'ProfessionalService',
                    'RadioStation',
                    'RealEstateAgent',
                    'RecyclingCenter',
                    'SelfStorage',
                    'ShoppingCenter',
                    'SportsActivityLocation'      => array(
                        'BowlingAlley',
                        'ExerciseGym',
                        'GolfCourse',
                        'HealthClub',
                        'PublicSwimmingPool',
                        'SkiResort',
                        'SportsClub',
                        'StadiumOrArena',
                        'TennisComplex',
                    ),
                    'Store'                       => array(
                        'AutoPartsStore',
                        'BikeStore',
                        'BookStore',
                        'ClothingStore',
                        'ComputerStore',
                        'ConvenienceStore',
                        'DepartmentStore',
                        'ElectronicsStore',
                        'Florist',
                        'FurnitureStore',
                        'GardenStore',
                        'GroceryStore',
                        'HardwareStore',
                        'HobbyShop',
                        'HomeGoodsStore',
                        'JewelryStore',
                        'LiquorStore',
                        'MensClothingStore',
                        'MobilePhoneStore',
                        'MovieRentalStore',
                        'MusicStore',
                        'OfficeEquipmentStore',
                        'OutletStore',
                        'PawnShop',
                        'PetStore',
                        'ShoeStore',
                        'SportingGoodsStore',
                        'TireShop',
                        'ToyStore',
                        'WholesaleStore'
                    ),
                    'TelevisionStation',
                    'TouristInformationCenter',
                    'TravelAgency'
                )
            );
        }

        function countryList()
        {
            return array(
                "AF" => "Afghanistan",
                "AX" => "Aland Islands",
                "AL" => "Albania",
                "DZ" => "Algeria",
                "AS" => "American Samoa",
                "AD" => "Andorra",
                "AO" => "Angola",
                "AI" => "Anguilla",
                "AQ" => "Antarctica",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AM" => "Armenia",
                "AW" => "Aruba",
                "AU" => "Australia",
                "AT" => "Austria",
                "AZ" => "Azerbaijan",
                "BS" => "Bahamas",
                "BH" => "Bahrain",
                "BD" => "Bangladesh",
                "BB" => "Barbados",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BZ" => "Belize",
                "BJ" => "Benin",
                "BM" => "Bermuda",
                "BT" => "Bhutan",
                "BO" => "Bolivia, Plurinational State of",
                "BQ" => "Bonaire, Sint Eustatius and Saba",
                "BA" => "Bosnia and Herzegovina",
                "BW" => "Botswana",
                "BV" => "Bouvet Island",
                "BR" => "Brazil",
                "IO" => "British Indian Ocean Territory",
                "BN" => "Brunei Darussalam",
                "BG" => "Bulgaria",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "KH" => "Cambodia",
                "CM" => "Cameroon",
                "CA" => "Canada",
                "CV" => "Cape Verde",
                "KY" => "Cayman Islands",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "CL" => "Chile",
                "CN" => "China",
                "CX" => "Christmas Island",
                "CC" => "Cocos (Keeling) Islands",
                "CO" => "Colombia",
                "KM" => "Comoros",
                "CG" => "Congo",
                "CD" => "Congo, the Democratic Republic of the",
                "CK" => "Cook Islands",
                "CR" => "Costa Rica",
                "CI" => "Côte d Ivoire",
                "HR" => "Croatia",
                "CU" => "Cuba",
                "CW" => "Curaçao",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DK" => "Denmark",
                "DJ" => "Djibouti",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "EC" => "Ecuador",
                "EG" => "Egypt",
                "SV" => "El Salvador",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "EE" => "Estonia",
                "ET" => "Ethiopia",
                "FK" => "Falkland Islands (Malvinas)",
                "FO" => "Faroe Islands",
                "FJ" => "Fiji",
                "FI" => "Finland",
                "FR" => "France",
                "GF" => "French Guiana",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GE" => "Georgia",
                "DE" => "Germany",
                "GH" => "Ghana",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GU" => "Guam",
                "GT" => "Guatemala",
                "GG" => "Guernsey",
                "GN" => "Guinea",
                "GW" => "Guinea-Bissau",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "HM" => "Heard Island and McDonald Islands",
                "VA" => "Holy See (Vatican City State)",
                "HN" => "Honduras",
                "HK" => "Hong Kong",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IN" => "India",
                "ID" => "Indonesia",
                "IR" => "Iran, Islamic Republic of",
                "IQ" => "Iraq",
                "IE" => "Ireland",
                "IM" => "Isle of Man",
                "IL" => "Israel",
                "IT" => "Italy",
                "JM" => "Jamaica",
                "JP" => "Japan",
                "JE" => "Jersey",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KE" => "Kenya",
                "KI" => "Kiribati",
                "KP" => "Korea, Democratic People's Republic of",
                "KR" => "Korea, Republic of,",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Lao Peoples Democratic Republic",
                "LV" => "Latvia",
                "LB" => "Lebanon",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LY" => "Libya",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MO" => "Macao",
                "MK" => "Macedonia, the former Yugoslav Republic of",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "ML" => "Mali",
                "MT" => "Malta",
                "MH" => "Marshall Islands",
                "MQ" => "Martinique",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "MX" => "Mexico",
                "FM" => "Micronesia, Federated States of",
                "MD" => "Moldova, Republic of",
                "MC" => "Monaco",
                "MN" => "Mongolia",
                "ME" => "Montenegro",
                "MS" => "Montserrat",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "MM" => "Myanmar",
                "NA" => "Namibia",
                "NR" => "Nauru",
                "NP" => "Nepal",
                "NL" => "Netherlands",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NI" => "Nicaragua",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "MP" => "Northern Mariana Islands",
                "NO" => "Norway",
                "OM" => "Oman",
                "PK" => "Pakistan",
                "PW" => "Palau",
                "PS" => "Palestine, State of",
                "PA" => "Panama",
                "PG" => "Papua New Guinea",
                "PY" => "Paraguay",
                "PE" => "Peru",
                "PH" => "Philippines",
                "PN" => "Pitcairn",
                "PL" => "Poland",
                "PT" => "Portugal",
                "PR" => "Puerto Rico",
                "QA" => "Qatar",
                "RE" => "Reunion",
                "RO" => "Romania",
                "RU" => "Russian Federation",
                "RW" => "Rwanda",
                "BL" => "Saint Barthélemy",
                "SH" => "Saint Helena, Ascension and Tristan da Cunha",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "MF" => "Saint Martin (French part)",
                "PM" => "Saint Pierre and Miquelon",
                "VC" => "Saint Vincent and the Grenadines",
                "WS" => "Samoa",
                "SM" => "San Marino",
                "ST" => "Sao Tome and Principe",
                "SA" => "Saudi Arabia",
                "SN" => "Senegal",
                "RS" => "Serbia",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SG" => "Singapore",
                "SX" => "Sint Maarten (Dutch part)",
                "SK" => "Slovakia",
                "SI" => "Slovenia",
                "SB" => "Solomon Islands",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "GS" => "South Georgia and the South Sandwich Islands",
                "SS" => "South Sudan",
                "ES" => "Spain",
                "LK" => "Sri Lanka",
                "SD" => "Sudan",
                "SR" => "Suriname",
                "SJ" => "Svalbard and Jan Mayen",
                "SZ" => "Swaziland",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "SY" => "Syrian Arab Republic",
                "TW" => "Taiwan, Province of China",
                "TJ" => "Tajikistan",
                "TZ" => "Tanzania, United Republic of",
                "TH" => "Thailand",
                "TL" => "Timor-Leste",
                "TG" => "Togo",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TT" => "Trinidad and Tobago",
                "TN" => "Tunisia",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "TC" => "Turks and Caicos Islands",
                "TV" => "Tuvalu",
                "UG" => "Uganda",
                "UA" => "Ukraine",
                "AE" => "United Arab Emirates",
                "GB" => "United Kingdom",
                "US" => "United States",
                "UM" => "United States Minor Outlying Islands",
                "UY" => "Uruguay",
                "UZ" => "Uzbekistan",
                "VU" => "Vanuatu",
                "VE" => "Venezuela, Bolivarian Republic of",
                "VN" => "Viet Nam",
                "VG" => "Virgin Islands, British",
                "VI" => "Virgin Islands, U.S.",
                "WF" => "Wallis and Futuna",
                "EH" => "Western Sahara",
                "YE" => "Yemen",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
            );
        }

        function contactType()
        {
            return array(
                "Customer Service",
                "Technical Support",
                "Billing Support",
                "Bill Payment",
                "Sales",
                "Reservations",
                "Credit Card Support",
                "Emergency",
                "Baggage Tracking",
                "Roadside Assistance",
                "Package Tracking"
            );
        }

        function languageList()
        {
            return array(
                "Akan",
                "Amharic",
                "Arabic",
                "Assamese",
                "Awadhi",
                "Azerbaijani",
                "Balochi",
                "Belarusian",
                "Bengali",
                "Bhojpuri",
                "Burmese",
                "Cantonese",
                "Cebuano",
                "Chewa",
                "Chhattisgarhi",
                "Chittagonian",
                "Czech",
                "Deccan",
                "Dhundhari",
                "Dutch",
                "English",
                "French",
                "Fula",
                "Gan",
                "German",
                "Greek",
                "Gujarati",
                "Haitian Creole",
                "Hakka",
                "Haryanvi",
                "Hausa",
                "Hiligaynon",
                "Hindi / Urdu",
                "Hmong",
                "Hungarian",
                "Igbo",
                "Ilokano",
                "Italian",
                "Japanese",
                "Javanese",
                "Jin",
                "Kannada",
                "Kazakh",
                "Khmer",
                "Kinyarwanda",
                "Kirundi",
                "Konkani",
                "Korean",
                "Kurdish",
                "Madurese",
                "Magahi",
                "Maithili",
                "Malagasy",
                "Malay/Indonesian",
                "Malayalam",
                "Mandarin",
                "Marathi",
                "Marwari",
                "Min Bei",
                "Min Dong",
                "Min Nan",
                "Mossi",
                "Nepali",
                "Oriya",
                "Oromo",
                "Pashto",
                "Persian",
                "Polish",
                "Portuguese",
                "Punjabi",
                "Quechua",
                "Romanian",
                "Russian",
                "Saraiki",
                "Serbo-Croatian",
                "Shona",
                "Sindhi",
                "Sinhalese",
                "Somali",
                "Spanish",
                "Sundanese",
                "Swahili",
                "Swedish",
                "Sylheti",
                "Tagalog",
                "Tamil",
                "Telugu",
                "Thai",
                "Turkish",
                "Ukrainian",
                "Uyghur",
                "Uzbek",
                "Vietnamese",
                "Wu",
                "Xhosa",
                "Xiang",
                "Yoruba",
                "Zulu",
            );
        }

        function socialList()
        {
            return array(
                'facebook'    => __('Facebook'),
                'twitter'     => __('Twitter'),
                'google-plus' => __('Google+'),
                'instagram'   => __('Instagram'),
                'youtube'     => __('Youtube'),
                'linkedin'    => __('LinkedIn'),
                'myspace'     => __('Myspace'),
                'pinterest'   => __('Pinterest'),
                'soundcloud'  => __('SoundCloud'),
                'tumblr'      => __('Tumblr'),
                'wikidata'    => __('Wikidata'),
            );
        }

        function imgInfo($url = null)
        {
            $img = array();
            if ($url) {
                $imgA = @getimagesize($url);
                if (is_array($imgA) && !empty($imgA)) {
                    $img['width'] = $imgA[0];
                    $img['height'] = $imgA[1];
                } else {
                    $img['width'] = 0;
                    $img['height'] = 0;
                }
            }

            return $img;
        }

        function isAssoc($array)
        {
            $keys = array_keys($array);

            return $keys !== array_keys($keys);
        }


    }
endif;