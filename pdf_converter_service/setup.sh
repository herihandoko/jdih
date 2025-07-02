#!/bin/bash

# PDF to MP3 Conversion Service Setup Script
# This script will setup the service automatically

set -e

echo "🚀 Setting up PDF to MP3 Conversion Service..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if Python 3 is installed
check_python() {
    print_status "Checking Python 3 installation..."
    if ! command -v python3 &> /dev/null; then
        print_error "Python 3 is not installed. Please install Python 3.8 or higher."
        exit 1
    fi
    
    PYTHON_VERSION=$(python3 --version | cut -d' ' -f2)
    print_status "Python 3 version: $PYTHON_VERSION"
}

# Check if pip is installed
check_pip() {
    print_status "Checking pip installation..."
    if ! command -v pip3 &> /dev/null; then
        print_error "pip3 is not installed. Please install pip3."
        exit 1
    fi
}

# Install Python dependencies
install_dependencies() {
    print_status "Installing Python dependencies..."
    pip3 install -r requirements.txt
    print_status "Dependencies installed successfully"
}

# Setup environment file
setup_env() {
    print_status "Setting up environment configuration..."
    
    if [ ! -f .env ]; then
        if [ -f env.example ]; then
            cp env.example .env
            print_status "Created .env file from template"
        else
            print_error "env.example file not found"
            exit 1
        fi
    else
        print_warning ".env file already exists, skipping..."
    fi
}

# Create necessary directories
create_directories() {
    print_status "Creating necessary directories..."
    
    mkdir -p logs
    mkdir -p storage/places/mp3
    mkdir -p storage/temp
    
    print_status "Directories created successfully"
}

# Setup database table
setup_database() {
    print_status "Setting up database table..."
    
    # Check if .env exists and has database config
    if [ ! -f .env ]; then
        print_error ".env file not found. Please run setup again after configuring .env"
        return
    fi
    
    # Read database config from .env
    source .env
    
    # Create SQL file for table creation
    cat > setup_database.sql << 'EOF'
CREATE TABLE IF NOT EXISTS pdf_conversion_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produk_hukum_id INT NOT NULL,
    pdf_filename VARCHAR(255) NOT NULL,
    judul_peraturan VARCHAR(500),
    status ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
    priority INT DEFAULT 2,
    text_content LONGTEXT,
    text_length INT DEFAULT 0,
    chunk_count INT DEFAULT 0,
    current_chunk INT DEFAULT 0,
    mp3_filename VARCHAR(255),
    tts_provider VARCHAR(50),
    retry_count INT DEFAULT 0,
    error_message TEXT,
    started_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_status_priority (status, priority),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (produk_hukum_id) REFERENCES produk_hukum_lists(id)
);
EOF

    print_status "Database SQL file created: setup_database.sql"
    print_warning "Please run the SQL manually in your database:"
    echo "mysql -u your_username -p your_database < setup_database.sql"
}

# Test configuration
test_configuration() {
    print_status "Testing configuration..."
    
    if [ ! -f .env ]; then
        print_error ".env file not found"
        return
    fi
    
    # Test Python imports
    python3 -c "
import sys
sys.path.append('.')
try:
    from config import Config
    print('✅ Configuration loaded successfully')
except Exception as e:
    print(f'❌ Configuration error: {e}')
    sys.exit(1)
"
}

# Setup cronjob
setup_cronjob() {
    print_status "Setting up cronjob..."
    
    # Get current directory
    CURRENT_DIR=$(pwd)
    
    # Create cronjob entry
    CRON_ENTRY="0 * * * * cd $CURRENT_DIR && python3 main.py >> logs/service.log 2>&1"
    
    print_warning "To setup cronjob, run the following command:"
    echo "crontab -e"
    echo "Then add this line (1 file per hour):"
    echo "$CRON_ENTRY"
    echo ""
    echo "Or for 1 file per 2 hours:"
    echo "0 */2 * * * cd $CURRENT_DIR && python3 main.py >> logs/service.log 2>&1"
}

# Setup systemd service (Linux only)
setup_systemd() {
    if [[ "$OSTYPE" == "linux-gnu"* ]]; then
        print_status "Setting up systemd service..."
        
        CURRENT_DIR=$(pwd)
        SERVICE_FILE="/etc/systemd/system/pdf-converter.service"
        
        sudo tee $SERVICE_FILE > /dev/null << EOF
[Unit]
Description=PDF to MP3 Conversion Service
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=$CURRENT_DIR
ExecStart=/usr/bin/python3 main.py
Restart=always
RestartSec=10
Environment=PATH=/usr/bin:/usr/local/bin

[Install]
WantedBy=multi-user.target
EOF

        print_status "Systemd service file created: $SERVICE_FILE"
        print_warning "To enable the service, run:"
        echo "sudo systemctl enable pdf-converter"
        echo "sudo systemctl start pdf-converter"
    else
        print_warning "Systemd service setup skipped (not Linux)"
    fi
}

# Main setup function
main() {
    echo "=========================================="
    echo "PDF to MP3 Conversion Service Setup"
    echo "=========================================="
    
    check_python
    check_pip
    install_dependencies
    setup_env
    create_directories
    setup_database
    test_configuration
    setup_cronjob
    setup_systemd
    
    echo ""
    echo "=========================================="
    echo "✅ Setup completed successfully!"
    echo "=========================================="
    echo ""
    echo "Next steps:"
    echo "1. Edit .env file with your configuration"
    echo "2. Add your OpenAI API key to .env"
    echo "3. Run database setup SQL"
    echo "4. Test the service: python3 main.py"
    echo "5. Setup cronjob or systemd service"
    echo ""
    echo "For more information, see README.md"
}

# Run main function
main "$@" 