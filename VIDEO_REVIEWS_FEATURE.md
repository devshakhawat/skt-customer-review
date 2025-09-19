# Video Reviews Feature

## Overview
This feature extends WooCommerce product reviews by adding a dedicated admin interface to manage reviews that contain videos. It provides a comprehensive list view similar to WooCommerce's native product reviews page.

## Features

### Admin Interface
- **Submenu Integration**: Adds a "Video Reviews" submenu under the main "Product Reviews" menu
- **List Table View**: Displays video reviews in a familiar WordPress admin table format
- **Status Filtering**: Filter reviews by status (All, Approved, Pending, Spam, Trash)
- **Search Functionality**: Search through review content, author names, and product titles
- **Sorting**: Sort by author, product, or date
- **Bulk Actions**: Perform bulk operations like approve, spam, trash, etc.

### Display Columns
1. **Author**: Shows reviewer avatar, name, email with action links
2. **Review**: Displays review content with status indicators
3. **Product**: Shows product name with edit and view links
4. **Rating**: Visual star rating display
5. **Video**: Video preview thumbnail with video count
6. **Date**: Review submission date and time

### Video Handling
- Displays video thumbnails in the admin table
- Shows video count when multiple videos are attached
- Supports the existing video upload functionality
- Uses the same video storage mechanism (comment meta)

## Technical Implementation

### Files Created
- `includes/video-reviews-list.php` - Main class handling the submenu and page display
- `includes/video-reviews-table.php` - WP_List_Table implementation for the reviews table

### Database Integration
- Uses existing comment meta storage for videos (`uploaded_video_url`)
- Queries comments with video attachments from WooCommerce products
- Integrates with WordPress comment system for status management

### Styling
- Matches WooCommerce admin interface styling
- Responsive video previews
- Star rating visual indicators
- Status-based styling for pending/spam reviews

## Usage

### Accessing Video Reviews
1. Navigate to WordPress Admin
2. Go to "Product Reviews" menu
3. Click on "Video Reviews" submenu
4. View and manage all reviews containing videos

### Managing Reviews
- **View**: Click "View" to see the review on the frontend
- **Edit**: Click "Edit" to modify the review in WordPress comment editor
- **Status Changes**: Use individual or bulk actions to change review status
- **Search**: Use the search box to find specific reviews
- **Filter**: Use status tabs to filter by review status

### Video Preview
- Videos are displayed as small previews in the table
- Click on videos to play them directly in the admin interface
- Multiple videos show a count indicator

## Integration Notes
- Seamlessly integrates with existing video review functionality
- Maintains compatibility with WooCommerce review system
- Uses WordPress native comment management features
- Follows WordPress coding standards and security practices

## Future Enhancements
- Video download functionality
- Advanced filtering options
- Export capabilities
- Video analytics and statistics